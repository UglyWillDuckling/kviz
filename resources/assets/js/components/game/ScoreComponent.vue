<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Score Component</div>

                    <div class="panel-body">
                        <ul>
                            <li v-for="item in list"
                                @click="showImage(item)">{{ item.name }}

                                <span @click="removeItem(item)">x</span>
                            </li>
                        </ul>
                        <h4>
                            Number of avatars is {{ avatars }}
                        </h4>
                        <button @click="removeAvatars">Remove avatars</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['list'],

        computed: {
            avatars: function () {
                var vm = this;
                return this.list.filter(function (item) {
                    return vm.hasAvatar(item);
                }).length;
            }
        },

        methods: {
            showImage: function (item) {
                if (item.avatar) {
                    alert(item.avatar);
                }
            },
            removeItem: function (item) {
                var index = this.list.indexOf(item)
                this.list.splice(index, 1)
            },
            
            hasAvatar: function (item) {
                return Boolean(item.avatar);
            },
            removeAvatars: function () {
                let vm = this;
                this.list = this.list.filter(function (item) {
                    return !vm.hasAvatar(item);
                });
            }
        },
    }
</script>
