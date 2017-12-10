<script>
    export default {
        data() {
            return {
                question: {//get the default values some otherway todo
                    body: '',
                    image: '',
                    image: '',
                    video: '',
                    'type_of_answer': '',
                    enabled: false,
                    'time_limit': 10,
                    'number_of_answers': 4,
                    answers: [],

                },
                showImage: false,
                showVideo: false,
                answerTypes: [
                    'text',
                    'image'
                ],
                answerNumbers: [
                    3, 4, 5
                ],
                minTimeLimit: 10,
                maxTimeLimit: 20,
            }
        },

        mounted() {
            if (this.data) {
                this.question = this.data

                if (this.question.image) {
                    this.showImage = true
                }

                this.question.video = 'http://techslides.com/demos/sample-videos/small.webm'//todo delete this

                if (this.question.video) {
                    this.showVideo = true
                }
            }
        },

        props: ['data'],

        computed: {
            hasImage: function () {
                return (this.question.image && this.showImage) ? true : false
            },
            hasVideo: function () {
                return (this.question.video && this.showVideo) ? true : false
            },
        },

        methods: {
            updateWithFile(file, prop) {
                var fr = new FileReader();
                fr.onload = () => {
                    this.question[prop] = fr.result;
                }
                fr.readAsDataURL(file);
            },
            updateImage(e) {
                this.updateWithFile(event.target.files[0], 'image')
            },
            updateVideo(e) {
                this.updateWithFile(event.target.files[0], 'video')
            },
            triggerImage(e) {
                this.$refs.imgInput.click()
            },
            triggerVideo() {
                this.$refs.videoInput.click()
            }
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
            <section>
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
                    <img alt="question" :src="question.image" @click="triggerImage" v-show="hasImage">
                    <input type="file" @change="updateImage" ref="imgInput" v-show="!hasImage">
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
                        <video alt="video question" v-show="hasVideo">
                            <source :src="question.video">
                        </video>
                    </div>
                    <a href="#" @click="triggerVideo">update video</a>
                    <input type="file" class="videoUpload" @change="updateVideo" ref="videoInput" v-show="!hasVideo">
                </div>
            </section>

            <section>
                <header>
                    <h4>Type of answer</h4>
                </header>
                <div>
                    <select v-model="question['type_of_answer']">
                        <option v-for="answerType in answerTypes" value="answerType">{{ answerType }}</option>
                    </select>
                </div>
            </section>
            <section>
                <header>
                    <h4>Number of answers</h4>
                </header>
                <div>
                    <select v-model="question['number_of_answers']">
                        <option v-for="n in answerNumbers" :value="n">
                            {{ n }}
                        </option>
                    </select>
                </div>
            </section>

            <section>
                <header>
                    <h4>Time Limit</h4>
                </header>
                <div>
                    <input type="number" v-model="question.time_limit" :maxlength="maxTimeLimit" :minlength="minTimeLimit">
                </div>
            </section>

            <section>
                <header>
                    <h4>Answers</h4>
                </header>
                <div>

                </div>
            </section>

        </div>
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

    img {
        max-width: 100%;
    }

    .right {
        text-align: right;
    }

    textarea {
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