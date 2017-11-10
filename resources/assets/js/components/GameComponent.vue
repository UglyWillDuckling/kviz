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

        <button @click="addPlayer">add player</button>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
            }
        },
//        mounted() {
//            this.$store.default.dispatch('players/fill')
//        },
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
            },

            addPlayer() {
                this.$store.commit('players/addPlayer', {
                    name: 'vladimir'
                });
            }
        },

        computed: {
            players() {
                return this.$store.getters['players/all'];
            },
            question() {
                return this.$store.getter['question'];
            }
        }
    };
</script>
