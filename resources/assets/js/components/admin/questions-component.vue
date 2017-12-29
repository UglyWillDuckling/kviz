<script>
    export default {
        data() {
            return {
                questions: {},
                selectedQuestions: {},
                defaultParams: {//TODO get default params from backend
                    page: 1,
                    'per_page': 20
                },
                queryParams: {},
                filterUpdated: true,
                filters: [//TODO get these filters from backend
                    {
                        type: 'dropdownfilter',
                        name: 'type',
                        label: 'Type of Question',
                        options: [
                            {
                                label: 'image',
                                value: 'image'
                            },
                            {
                                label: 'video',
                                value: 'video'
                            },
                            {
                                label: 'text',
                                value: 'text'
                            }
                        ]
                    }, {
                        label: 'Is Multipart',
                        type: 'yesnofilter',
                        name: 'isMultipart'
                    },
                    {
                        type: 'dropdownfilter',
                        name: 'status',
                        label: 'Status',
                        options: [
                            {
                                label: 'approved',
                                value: '1'
                            },
                            {
                                label: 'waiting',
                                value: '0'
                            },
                            {
                                label: 'rejected',
                                value: '2'
                            },

                        ]
                    }
                ],
            }
        },

        props: ['params'],

        mounted() {
            this.queryParams = _.extend(this.params, this.defaultParams)
            //load the questions from backend
            this.getQuestions();
        },

        computed: {
            empty() {
                return _.isEmpty(this.questions);
            }
        },

        methods: {
            getQuestions() {
                if (!this.filterUpdated) {
                    return
                }
                this.filterUpdated = false
                axios
                    .get('/api/questions', {
                        params: _.pickBy(this.queryParams, _.identity)//throw out empty params
                    })
                    .then(({data}) => {
                        let result = data.result
                        if (data.success && result.questions) {
                            this.questions = result.questions;
                        } else {
                            this.error = data.msg || 'no questions found with the given parameters'
                        }
                    }).catch((error) => {
                    console.log(error.response)
                    this.error = error.response
                })
            },
            updateParams(filter, value) {
                this.queryParams[filter] = value
                if (value) {
                    this.filterUpdated = true
                }
            },
            toggleSelected(question) {
                if (this.selectedQuestions[question.id]) {
                    _.unset(this.selectedQuestions, question.id)
                    return
                }
                this.selectedQuestions[question.id] = question
            },
            editQuestion() {
                console.log('redirect to question page')


            }
        },
        components: {
            dropdownfilter: require('./filters/dropdown'),
            yesnofilter: require('./filters/yesno'),
        }
    }
</script>
<template>
    <div>
        <section>
            <div class="filters">
                <div class="filter" v-for="filter in filters">
                    <h4>{{ filter.label }}</h4>
                    <component :is="filter.type" :name="filter.name" :options="filter.options"
                               v-on:filter_chanaged="updateParams"></component>
                </div>
            </div>
            <button @click="getQuestions" v-show="filterUpdated">apply filters</button>
        </section>
        <ul class="questions" :class="{empty: empty}">
            <li v-for="question in questions" :key="question.id">
                <div>
                    <label>
                        <input type="checkbox" @change="toggleSelected(question.id)">
                    </label>
                </div>
                <div>
                    {{ question.body }}
                </div>
                <div class="edit">
                    <a href="#" :href="'/admin/question/edit/' + question.id">edit</a>
                </div>
            </li>
        </ul>
    </div>
</template>
<style scoped lang="scss">
    * {
        text-align: center;
    }

    section {
        margin-bottom: 10px;
    }
    
    .filters {
        display: flex;
        justify-content: space-evenly;
        margin-bottom: 10px;
    }
    .questions  {
        padding: 0;
        li {
            display: flex;
            margin-bottom: 10px;
            padding: 10px 0;
            border: 1px solid #cecccc;

            > div {
                min-width: 10%;
                text-align: center;
                label {
                    width: 100%;
                    height: 100%;
                }
            }
        }
    }
</style>