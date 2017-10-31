<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Game Component</div>

                    <div class="panel-body">
                        I am the only game you will ever need!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: {
            players: {
                //players currently in the game
                player1: {
                    name: 'player1',
                    avatar: 'image',
                    rank: '3'
                }
            },

            question: {
                //the current question

            },
        },

        mounted() {
            console.log('Game Component mounted.')
        },
        loadNextQuestion() {
            //get the next question from the server
            this.replaceQuestion();
        },
        replaceQuestion() {
            //replace the current question, if there is one, with the new one
            this.data.question = {};
        }
    }
</script>
