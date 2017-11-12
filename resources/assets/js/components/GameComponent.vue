<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="question">
                            <div>
                                <!--show the question-->
                                <p>{{ question.body }}</p>

                                <div v-if="question.image" class="image_wrapper">
                                    <img :src="question.image" alt="question image">
                                </div>
                                <div v-else-if="question.video" class="video_wrapper">
                                    <video :src="question.video" alt="video">
                                        Sorry, your browser doesn't support HTML5 <code>video</code>
                                    </video>
                                </div>
                            </div>
                            <div class="answers">
                                <div
                                        v-for="answer in answers"
                                        class="answer"
                                                 v-bind:class="{ selected: (selectedAnswer == answer) }"
                                        @click="selectAnswer(answer, $event)">
                                    <div v-if="answerType == 'text'" class="answer_text">
                                        {{ answer.content }}
                                    </div>
                                    <div v-else-if="answerType == 'image'" class="answer_image">
                                        <img :src="answer.image" alt="answer image">
                                    </div>
                                    <div v-else-if="answerType == 'video'" class="answer_video">
                                        <img :src="answer.video" alt="answer video">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--<button @click="regenerate">re render</button>-->
                        <!--<score-component></score-component>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                selectedAnswer: ''
            }
        },
        mounted() {
            console.log('mounted game')
        },
        methods: {
            loadNextQuestion: function () {
                //get the next question from the server
                this.replaceQuestion();
            },
            replaceQuestion: function () {
                //replace the current question, if there is one, with the new one
                this.data.question = {};
            },

            addPlayer() {
                this.$store.commit('players/addPlayer', {
                    name: 'vladimir'
                });
            },
            selectAnswer(answer) {
//                if (this.selectedAnswer) {
//                    return;
//                }
                this.selectedAnswer = answer;
                //register the choose answer event

            },
            regenerate() {
                //todo remove this
                console.log('regen');
            }
        },

        computed: {
            players() {
                return this.$store.getters['players/all']
            },
            question() {
                return this.$store.getters['question/question']
            },
            answers() {
                return this.$store.getters['question/answers']
            },
            answerType() {
                return this.question.answerType
            }
        }
    };
</script>
<style lang="scss" scoped>
    .selected {
        background: green;
        color: white;
    }

    .image_wrapper {
        padding: 15px 0
    }

    img {
        max-width: 100%;
    }
</style>
