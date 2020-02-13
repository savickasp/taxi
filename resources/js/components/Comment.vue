<template>
    <div class="width-100proc p-2" >
        <div class="d-flex flex-row justify-content-between width-100proc">
            <p>{{comment.name}} </p>
            <p> {{comment.created_at}}</p>
        </div>
        <div class="comment-container width-100proc" v-show="!edit_status">
            <p>{{this.data.body}}</p>
            <button v-if="editable" @click="edit_status = true" class="btn btn-secondary">edit</button>
        </div>
        <div class="" v-show="edit_status">
            <div>
                <span>Update comment</span>
            </div>
            <div class="d-flex flex-column">
                <textarea v-model="data.body" class="form-control"></textarea>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success m-1" @click="saveComment">Update</button>
                    <button class="btn btn-primary m-1" @click="resetComment">Cancel</button>
                    <button class="btn btn-danger m-1" @click="deleteComment">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'comment',
        props: {
            comment: {
                required: true,
                type: Object,
            },
            user: {
                type: [Object, Boolean]
            }
        },
        computed: {
            editable() {
                if (!this.user) return false;
                return this.user.id === this.comment.user_id;
            }
        },
        methods: {
            saveComment: function () {
                this.edit_status = false;

                this.$emit('comment-update', {
                    'id': this.comment.id,
                    'body': this.data.body,
                });
            },
            resetComment: function () {
                this.data.body = this.comment.body;
                this.edit_status = false;
            },
            deleteComment: function () {
                this.$emit('comment-delete', {
                    'id': this.comment.id
                });
            }
        },
        data: function() {
            return {
                edit_status: false,
                data: {
                    body: this.comment.body,
                }
            }
        },
    }
</script>
