<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">

                        <!--<ul>-->
                            <!--<li v-for="task in tasks"-->
                                <!--:class="{'completed' : task.completed}"-->
                                <!--@click="task.completed = !task.completed">{{ task.body }}</li>-->
                        <!--</ul>-->


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
                tasks: [
                    {body:  'Go to the Store',  completed: true},
                    {body: 'Go to the Bank',    completed: false},
                    {body: 'Go to the Doctor',  completed: false},
                ]
            }
        },
        computed: {

        } ,

        methods: {
            toggleCompletedFor: function (task) {
                task.completed = !task.completed;
            }
        }
    };
</script>
<style>
    .completed {
        text-decoration: line-through;
    }
</style>
