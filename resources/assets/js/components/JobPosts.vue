<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="pull-left">Jobs</h4>
            <div class="pull-right">
                <button class="btn btn-primary" @click.prevent="showModal"><i class="glyphicon glyphicon-plus"></i> Add Job</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="panel panel-primary" v-if="jobs" v-for="job in jobs">
                <h5 class="panel-heading">{{job.title}}</h5>
                <div class="panel-body">
                    <h5 class="panel-title">{{job.company}}</h5>
                    <p class="panel-content">{{job.description}}</p>
                    <p class="text-muted">{{job.location}}</p>
                </div>
            </div>
            <add-job-post v-show="show" :jobs="jobs" @close="closeModal"></add-job-post>
        </div>
    </div>
</template>

<script>
    import JobFormModal from './JobFormModal.vue';

    export default {
        props: ['jobs'],
        data()
        {
            return {
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
            }
        },
        components: {
            'add-job-post': JobFormModal
        }
    }
</script>