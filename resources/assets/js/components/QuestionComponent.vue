<template>
    <div class="container">
        <div id="question" class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Question Component</div>

                    <div class="panel-body">
                        <div class="loader">
                            the question is loading
                        </div>
                        <div v-if="loaded" class="content">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'question',

        //show the question

        //answer the question

        //show answer

        data() {
            return {
                //when the question is loaded this variable will change and the question will be shown
                loaded: false
            }
        },
        methods: {
            show: function () {
                //console.log('show the question when it's loaded');
            }
        }
    };
</script>