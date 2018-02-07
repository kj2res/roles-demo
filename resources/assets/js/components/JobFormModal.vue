<template>
    <div id="addJobPost" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Post a Job</h4>
                </div>
                <div class="modal-body">
                    <form class="form" @submit.prevent="submitForm">

                        <div class="form-group" :class="errors.title ? 'has-danger text-danger mb-1':''">
                            <label for="title">Title</label>
                            <input class="form-control" name="user_id" v-model="form.title" id="title" @keydown="errors.title = ''">
                            <span v-for="error in errors.title" class="help-block">
                                <small class="text-danger">{{ error }}</small>
                            </span>
                        </div>

                        <div class="form-group" :class="errors.description ? 'has-danger text-danger mb-1':''">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" v-model="form.description" @keydown="errors.description = ''" id="description" rows="5"></textarea>
                            <span v-for="error in errors.description" class="help-block">
                                <small class="text-danger">{{ error }}</small>
                            </span>
                        </div>

                        <div class="form-group" :class="errors.location ? 'has-danger text-danger mb-1':''">
                            <label for="location">Location</label>
                            <input class="form-control" name="location" v-model="form.location" id="location" @keydown="errors.location = ''">
                            <span v-for="error in errors.location" class="help-block">
                                <small class="text-danger">{{ error }}</small>
                            </span>
                        </div>

                        <div class="form-group" :class="errors.company ? 'has-danger text-danger mb-1':''">
                            <label for="company">Company</label>
                            <input class="form-control" name="company" v-model="form.company" id="company" @keydown="errors.company = ''">
                            <span v-for="error in errors.company" class="help-block">
                                <small class="text-danger">{{ error }}</small>
                            </span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-block btn-info">
                                <i v-if="form.busy" class="fa fa-spinner fa-pulse"></i>
                                <span v-else="form.busy">Post Job</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect"
                            @click="$emit('close')">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform';

    export default {
        props: ['jobs'],
        data() {
            return {
                form: new Form({
                    title: null,
                    description: null,
                    location: null,
                    company: null
                }),
                errors: []
            }
        },
        methods: {
            submitForm() {
                this.form.post('/jobs/create').then((res) => {
                    this.jobs.push(res.data);
                    this.errors = [];
                    this.$emit('close');
                    this.$swal({
                        title: "Success!",
                        text: "Your job post has been submitted. The Admin will now carefully review the information you've provided",
                        type: "success",
                        timer: 3200,
                        showConfirmButton: false
                    });
                    this.form.reset();
                }, function () {
                    this.$swal({
                        title: "Oops!",
                        text: "Failed.",
                        type: "error",
                        timer: 3200,
                        showConfirmButton: false
                    });
                    this.errors = this.form.errors.errors;
                }.bind(this));
            }
        }
    }
</script>