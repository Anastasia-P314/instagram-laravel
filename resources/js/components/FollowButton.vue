<template>
    <div class="container">
        <button class="btn btn-primary ms-3" @click="followUser" v-text="buttonText" v-if="hidebutton"></button>
   <!--      <span v-text="followers"></span> -->
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows', 'authUser'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios
                    .post('/follow/' + this.userId)
                    .then(response => {
                        //console.log(response.data);
                        this.status = ! this.status;
                    })
                    .catch(errors => {
                        if(errors.response.status == 401) {
                            window.location = '/login';
                        }
                    })
                }
        },

        computed: {
            buttonText() { 
                return (this.status) ? "Unfollow" : "Follow";
            },
            hidebutton() {
                return this.userId != this.authUser;
            }
        }
    }
</script>
