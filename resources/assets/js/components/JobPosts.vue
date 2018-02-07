<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="pull-left">Jobs</h4>
            <div class="pull-right" v-if="cancreatejob">
                <button class="btn btn-primary" @click.prevent="showModal"><i class="glyphicon glyphicon-plus"></i> Add Job</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="panel panel-primary" v-if="jobs" v-for="(job, index) in jobs">
                <div class="panel-heading">{{job.title}}</div>
                <div class="panel-body">
                    <p><h5 class="panel-title">{{job.company}}</h5></p>
                    <p class="panel-content">{{job.description}}</p>
                    <p class="text-muted"><i class="glyphicon glyphicon-map-marker"></i> {{job.location}}</p>
                </div>
                <div class="panel-footer">
                    <button v-if="canapplyjob" class="btn btn-info" @click="apply(job)"> Apply </button>
                    <button v-if="canapplyjob" class="btn btn-info" @click="removeApplication(job)"> Remove My Application </button>
                    <button v-else-if="canapprovejob" class="btn btn-warning" @click="approve(job, index)"> Approve </button>
                </div>
            </div>
            <add-job-post v-show="show" :jobs="jobs" @close="closeModal"></add-job-post>
        </div>
    </div>
</template>

<script>
    import JobFormModal from './JobFormModal.vue';
    import Form from 'vform';

    export default {
        props: ['jobs', 'cancreatejob', 'canapplyjob', 'canapprovejob'],
        data()
        {
            return {
                form: new Form(),
                show: false
            }
        },
        methods: {

            showModal() {
                this.show = true;
                $('#addJobPost').modal('show');
            },

            closeModal() {
                this.show = false;
                $('#addJobPost').modal('hide');
            },

            approve(job, index) {
                this.form.put('/jobs/approve/' + job.id).then((res) => {
                    this.jobs.splice(index, 1);
                    this.$swal({
                        title: "Success!",
                        text: "Job Post Approved Successfully",
                        type: "success",
                        timer: 3200,
                        showConfirmButton: false
                    });
            }, function() {
                    this.$swal({
                        title: "Oops!",
                        text: "Failed.",
                        type: "error",
                        timer: 3200,
                        showConfirmButton: false
                    });
                }.bind(this));
            },

            apply(job) {
                this.form.post('/user/apply/' + job.id).then((res) => {
                    this.$swal({
                        title: "Success!",
                        text: "Applied Successfully",
                        type: "success",
                        timer: 3200,
                        showConfirmButton: false
                    });
                }, function() {
                    this.$swal({
                        title: "Oops!",
                        text: "Failed.",
                        type: "error",
                        timer: 3200,
                        showConfirmButton: false
                    });
                }.bind(this));
            },

            removeApplication(job) {
                this.form.post('/user/remove/' + job.id).then((res) => {
                    this.$swal({
                    title: "Success!",
                    text: "Job Application Cancelled Successfully",
                    type: "success",
                    timer: 3200,
                    showConfirmButton: false
                });
            }, function() {
                    this.$swal({
                        title: "Oops!",
                        text: "Failed.",
                        type: "error",
                        timer: 3200,
                        showConfirmButton: false
                    });
                }.bind(this));
            }
        },
        components: {
            'add-job-post': JobFormModal
        }
    }
</script>