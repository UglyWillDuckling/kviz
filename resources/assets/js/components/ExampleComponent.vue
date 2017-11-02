<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">

                        <div class="wrapper">
                            <h3>My tasks</h3>
                            <ul class="list-group">
                                <li class="list-group-item" v-for="task in list">{{ task.body }}</li>
                            </ul>
                        </div>

                        <alert type="success">
                            Success! Account created. Huzzzaaahhh!!!
                        </alert>
                        <alert type="warning">
                            warning
                        </alert>
                        <alert type="fail">
                            You failed.
                        </alert>
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
                list: []
            }
        },

        created: function () {
            this.list = this.loadTasks();
        },

        methods: {
            toggleCompletedFor: function (task) {
                task.completed = !task.completed;
            },
            loadTasks: function () {
                axios.get('api/tasks').then(function (response) {
                    if (response.data.success && response.data.tasks) {
                        this.list = response.data.tasks;
                    }
                }.bind(this));
            }
        },

        components: {
            alert: require('./example/AlertComponent')
        }
    };
</script>
<style>
    .completed {
        text-decoration: line-through;
    }
</style>
