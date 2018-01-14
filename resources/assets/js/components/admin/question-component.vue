<script>
    var validUrl = require('valid-url');

    export default {
        data() {
            return {
                question: {
                    body: '',
                    image: '',
                    image: '',
                    video: '',
                    'type_of_answer': '',
                    enabled: false,
                    'time_limit': 10,
                    'number_of_answers': 4,
                    answers: [],
                    categoryIds: [],

                },
                image: '',
                video: '',
                showImage: false,
                showVideo: false,
                answerTypes: [
                    'text',
                    'image'],
                origAnswers: [],
                answerNumbers: [
                    3, 4, 5
                ],
                minTimeLimit: 8,
                maxTimeLimit: 20,

                fileArray: [
                    'image',
                    'video'
                ],

                fileInputs: {
                    image: {
                        name: 'image',
                        showInput: false
                    },
                    video: {
                        name: 'video',
                        showInput: false
                    }
                },
                categories: [
                    {
                        name: 'Povijest',
                        id: 1
                    },
                    {
                        name: 'Zemljopis',
                        id: 2
                    },
                    {
                        name: 'Fizika',
                        id: 3
                    },
                ]
            }
        }
        ,

        mounted() {
            if (this.data.question) {
                this.question = JSON.parse(this.data.question)

                this.origAnswers = this.question.answers
                if (this.question.image) {
                    this.showImage = true
                    this.image = this.question.image
                }
                if (this.question.video) {
                    this.showVideo = true
                    this.video = this.question.video
                }
            }
            this.categories = this.data.categories
        }
        ,

        props: ['data'],

        computed: {
            hasImage: function () {
                return (this.question.image && this.showImage) ? 1 : 0
            },
            hasVideo: function () {
                return (this.question.video && this.showVideo) ? 1 : 0
            },
        },

        methods: {
            saveQuestion() {
                let data = new FormData()
                for (var prop in this.question) {
                    if (this.question.hasOwnProperty(prop)) {
                        if (prop == 'answers') {
                            data.append(prop, JSON.stringify(this.question[prop]))
                            continue
                        }
                        if (_.includes(this.fileArray, prop) && !this[`has${_.capitalize(prop)}`]) {
                            continue
                        }
                        data.append(prop, this.question[prop])
                    }
                }
                data.append('has_video', this.hasVideo)
                data.append('has_image', this.hasImage)

                axios.post('/admin/question/edit', data)
                    .then((response) => {
                        if (response.success) {
                            //redirect
                            window.location('/admin/questions')
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
            ,
            updateAnswerType() {

            }
            ,
            updateAnswers(e) {
                let val = e.target.value
                let diff = val - this.question.number_of_answers
                if (diff > 0) {
                    for (let i = 0; i < diff; i++) {
                        //add new answers
                        this.question['answers'].push({
                            'content': '',
                            'type': this.question['type_of_answer']
                        })
                    }
                } else if (diff < 0) {
                    this.question['answers'].splice(diff, Math.abs(diff))
                }
                this.question['number_of_answers'] = val
            }
            ,
            updateWithFile(file, fileType) {
                var fr = new FileReader();
                fr.onload = () => {
                    this[fileType] = fr.result
                }
                fr.readAsDataURL(file);
                return fr;
            },
            updateInput(fileType, value) {
                // console.log(value)
                if (!value) {
                    return
                }
                if (_.isObject(value)) {
                    this.updateWithFile(value, fileType)
                    this.question[fileType] = value
                    return
                }
                if (validUrl.isUri(value)) {
                    this.question[fileType] = value
                    this[fileType] = value
                    return
                } else {
                    alert('something is wrong with the url you submitted')
                }
            },

            hideModals() {
                _.each(this.fileInputs, function (fileInput) {
                    fileInput.showInput = false
                })
            },
        }
    }
</script>
<template>
    <div class="question">
        <section>
            <header>
                <h4>Enabled</h4>
                <div class="subheader right">
                    <label class="switch">
                        <input type="checkbox" v-model="question.enabled">
                        <span class="slider round"></span>
                    </label>
                </div>
            </header>
        </section>

        <div class="options">
            <div class="overlay"></div>
            <section class="body">
                <header>
                    <h4>Question body</h4>
                </header>
                <textarea
                        placeholder="The question body" rows="20" cols="40" class="ui-autocomplete-input"
                        autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"
                        v-model="question.body"></textarea>
            </section>

            <section class="question-image">
                <header>
                    <h4>has Image</h4>
                    <div class="subheader right">
                        <label class="switch">
                            <input type="checkbox" v-model="showImage">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </header>

                <div v-show="showImage">
                    <img alt="question" :src="this.image" ref="questionImage" @click="fileInputs.image.showInput = true" v-show="hasImage">
                </div>
            </section>

            <section class="question-video">
                <header>
                    <h4>has Video</h4>
                    <div class="subheader right">
                        <label class="switch">
                            <input type="checkbox" v-model="showVideo">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </header>

                <div v-show="showVideo">
                    <div>
                        <video alt="video question" ref="questionVideo" v-show="hasVideo" controls :src="this.video">
                        </video>
                    </div>
                    <a href="#" @click="fileInputs.video.showInput = true">update video</a>
                </div>
            </section>

            <section>
                <header>
                    <h4>Type of answer</h4>
                </header>
                <div>
                    <select v-model="question['type_of_answer']">
                        <option v-for="answerType in answerTypes" :value="answerType">{{ answerType }}</option>
                    </select>
                </div>
            </section>
            <section>
                <header>
                    <h4>Time Limit</h4>
                </header>
                <div>
                    <input type="number" v-model="question.time_limit" :max="maxTimeLimit" :min="minTimeLimit">
                </div>
            </section>

            <section>
                <header>
                    <h4>Number of answers</h4>
                </header>
                <div>
                    <select @change="updateAnswers" :value="question.number_of_answers">
                        <option v-for="n in answerNumbers" :value="n">
                            {{ n }}
                        </option>
                    </select>
                </div>
            </section>

            <section>
                <header>
                    <h4>Answers</h4>
                </header>
                <div>
                    <div v-for="answer in question.answers" class="answer">
                        <textarea cols="20" rows="10" v-model="answer.content">
                        </textarea>
                    </div>
                </div>
            </section>

            <section>
                <header>
                    <h4>Categories</h4>
                </header>
                <div>
                    <select v-model="question.categoryIds" multiple>
                        <option v-for="category in this.categories" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
            </section>

            <section class="save">
                <button @click="saveQuestion">Save</button>
            </section>
        </div>

        <modal-input-component
                v-show="fileInputs[fileName].showInput" @close="hideModals()"
                v-for="fileName in fileArray" :key="fileName" :valueName="fileName"
                @update="updateInput"></modal-input-component>
    </div>
</template>

<style scoped lang="scss">
    div {
        margin: auto;
    }

    .question {
        width: 90%;

        margin-bottom: 50px;
    }

    section {
        margin-bottom: 15px;
    }

    h3 {
        color: #313131;
    }

    h4 {
        display: inline-block;
        width: 69%;
    }

    .subheader {
        width: 30%;
        display: inline-block;
    }

    videoUpload {
        display: none;
    }

    img, video {
        max-width: 100%;
    }

    .right {
        text-align: right;
    }

    .answer {
        textarea {
            width: 85%;
            height: 85px;
        }
    }

    .save {
        text-align: right;
    }

    .body textarea {
        margin-top: 10px;
        width: 100%;
        height: 150px;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
        border-image: none;
        border-radius: 6px 6px 6px 6px;
        border-style: none solid solid none;
        border-width: medium 1px 1px medium;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
        color: #555555;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 1.4em;
        padding: 5px 8px;
        transition: background-color 0.2s ease 0s;
        resize: vertical;
    }

    textarea:focus {
        background: none repeat scroll 0 0 #FFFFFF;
        outline-width: 0;
    }

    /*slide yes/no */
    .switch {
        position: relative;
        display: inline-block;
        width: 55px;
        height: 25px;

        input[type=checkbox] {
            display: none;
        }
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 5px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    label {
        margin-bottom: 0;
    }

    /*slide yes/no */
</style>