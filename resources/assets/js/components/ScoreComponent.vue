<template>
    <div class="score">
        <!--show the score-->
        <ul>
            <li v-for="player in players">{{ player.nickname }} <span>{{ player.correct }}</span></li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            players() {
                return this.$store.getters['players/all'].sort((a, b) => {
                    if ((a.correct - a.wrong) < (b.correct - b.wrong)) return -1;
                    if ((a.correct - a.wrong) > (b.correct - b.wrong)) return -1;
                    return 0;
                });
            }
        },

        methods: {
        },
    }
</script>
