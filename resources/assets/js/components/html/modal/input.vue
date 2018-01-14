<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                       Enter the value for {{ valueName }}
                    </div>

                    <div class="modal-body">
                        <label> Value:
                            <input type="text" @change="textValueChange">
                        </label>
                        <label>
                            <input type="file" @change="inputChange">
                        </label>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button" @click="$emit('close', valueName); $emit('update', valueName, value)">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    import ModalComponent from '../ModalComponent'
    export default {
        extends: ModalComponent,

        data: function () {
            return {
                value: ''
            }
        },
        props: ['valueName', 'inputHandler'],

        mounted() {
         // console.log(this.valueName)
        },

        methods: {
            inputChange(e) {
                this.value = e.currentTarget.files[0]
            },
            textValueChange(e) {
                this.value = e.currentTarget.value
            }
        }
    };
</script>
