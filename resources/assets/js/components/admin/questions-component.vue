<template>
    <div class="questions">
        <h3>questions component</h3>

        <ul class="questions" :class="{empty: empty}">
            <li v-for="question in questions" :key="question.id">
                {{ question.body }}
            </li>
        </ul>
    </div>

</template>

<script>
    export default {

        data() {
          return {
              params: {
                  questions: {},
                  pageSize: 20,
                  page: 1,
                  category: null
              }
          }
        },

        props: ['params'],

        mounted() {
            this.setDefaultParams()

            //load the questions from backend
            this.getQuestions({
                page: this.params.page,
                size: this.params.pageSize,
                category: this.params.category,
                type: 'image'
            });
        },

        computed: {
            empty() {
                return _.isEmpty(this.questions);
            }
        },

        methods: {
            getQuestions($params) {
                axios.get('/api/questions', $params).then(function (response) {
                    if (response.data.success && response.data.questions) {
                        this.questions = response.data.questions;
                    }
                }.bind(this));
            },
            setDefaultParams() {

            }
        },
    }
</script>
