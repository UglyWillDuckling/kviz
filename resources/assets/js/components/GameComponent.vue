<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Game Component</div>

                    <div class="panel-body">
                        I am the only game you will ever need!

                        <score :list="players"></score>
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
                players: [
                    //players currently in the game
                     {
                        name: 'Doris',
                        avatar: 'image',
                        rank: '3'
                    },
                    {
                        name: 'Marko',
                        avatar: '',
                        rank: '2'
                    },
                    {
                        name: 'Zoki',
                        avatar: '',
                        rank: '4'
                    },
                ],

                question: {
                    //the current question

                },
            }
        },
        components: {
            score: require('./game/ScoreComponent.vue')
        },

        methods: {
            loadNextQuestion: function () {
                //get the next question from the server
                this.replaceQuestion();
            },
            replaceQuestion: function () {
                //replace the current question, if there is one, with the new one
                this.data.question = {};
            }
        }

    };
</script>
