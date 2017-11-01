<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        <!--<p class="alert alert-danger" v-show="!message">You must enter a message</p>-->

                        <!--<textarea name="" id="" cols="30" rows="10" v-model="message"></textarea>-->
                        <!--<button type="submit" v-show="message">Send Message</button>-->

                        <!--<form action="/submit" @submit.prevent="handleIt">-->
                        <!--</form>-->
                        <!--<button @click="count++">Count {{ count }}</button>-->


                        <!--<h1>Skill: {{ skill }}</h1>-->

                        <!--<input type="text" name="" id="" v-model="points">-->

                        <!--<h1>{{ fullName }}</h1>-->

                        <!--<input type="text" class="text" v-model="first">-->
                        <!--<input type="text" class="text" v-model="last">-->

                        <div v-for="plan in plans">
                            <plan :plan="plan" :current.sync="current"></plan>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--<template id="plan-template">-->
    <!--<div>-->
        <!--<span>{{ plan.name }}</span>-->
        <!--<span>{{ plan.price }}</span>-->
    <!--</div>-->
<!--</template>-->

<script>
    export default {
        data: function () {
            return {
                count: 0,
                message: '',
                points: 50,
                first: 'Jeffrey',
                last: 'Way',

                plans: [
                    {name: 'Enterprise', price: 100},
                    {name: 'Pro', price: 50},
                    {name: 'Personal', price: 10},
                    {name: 'Free', price: 0}
                ],
                current: {}
            }
        },

        components: {
            plan: {
                template: `
                    <div style="display: table;">
                        <span>{{ plan.name }}</span>
                        <span>{{ plan.price }}/month</span>
                        <button v-if="current.name !== plan.name" @click="setcurrentPlan">{{ isUpgrade ? 'Upgrade' : 'Downgrade' }}</button>
                        <span v-else="">Selected</span>
                    </div>
                                    `,
                props: ['plan', 'current'],

                computed: {
                    isUpgrade: function () {
                        return this.plan.price > this.current.price;
                    }
                },
                
                methods: {
                    setcurrentPlan: function () {
                        this.$emit('update:current', this.plan);
                    }
                }
            }
        },

        props: ['subject'],

        computed: {
          skill: function() {
              if(this.points <= 100) {
                  return 'Noob';
              }

              return 'Advanced';
          }
        },

        computed: {
            fullName: function() {
                return this.first + ' ' + this.last;
            }
        } ,

        methods: {
            handleIt: function (e) {
                alert('submitting the form.');
            },
            clicked: function () {
                alert('dont touch me!');
            },

            updateCount: function () {
                this.count += 1;
            }
        }
    };
</script>
