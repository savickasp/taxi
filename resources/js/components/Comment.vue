<template>
    <div>
        <div>
            <div class="w-100 pb-2 comment">
                <div class="comment-owner d-flex flex-row justify-content-between width-100proc">
                    <span class="pl-2">{{comment.name}} </span>
                    <div class="mr-2">
                        <button v-if="editable" @click="edit_status = true" class="ml-2 btn-link mt-1 mb-1">edit
                        </button>
                        <span> {{comment.created_at}}</span>
                    </div>
                </div>
                <div class="comment-container width-100proc" v-show="!edit_status">
                    <div class="pl-2">
                        <span>{{this.data.body}}</span>
                    </div>
                    <div>
                        <button v-if="user.id"
                                @click="reply_status = !reply_status"
                                class="ml-2 btn-link">
                            reply
                        </button>
                    </div>
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
                <div class="w-75 m-auto" v-if="reply_status">
                    <new-comment @comment-create="storeSubComment($event)"
                                 @clear-comment="reply_status = false"
                                 :user="user"
                                 :parrent_id="comment.id"
                    ></new-comment>
                </div>

            </div>
            <div class="subComment">
                <comment v-for="subcomment in subcomments"
                         :user="user"
                         :key="subcomment.id"
                         :comment="subcomment"
                         @comment-update="updateSubComment($event)"
                         @comment-delete="deleteSubComment($event)"
                         @comment-create="storeSubComment($event)"
                ></comment>

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
        created() {
            this.fetchComment(this.comment.id);
        },
        computed: {
            editable() {
                if (!this.user) return false;
                return this.user.id === this.comment.user_id;
            }
        },
        methods: {
            fetchComment: function (data) {
                axios.get('/api/comment?parrent=' + this.comment.id)
                    .then(({data}) => {
                        this.subcomments = data;
                    })
            },
            updateSubComment: function (data) {
                axios.put('/api/comment/' + data.id + '?api_token=' + this.user.api_token, data)
                    .then(({}) => {
                        this.subcomments[this.commentIndex(data)].body = data.body;
                    })
            },
            deleteSubComment: function (data) {
                axios.delete('/api/comment/' + data.id + '?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.subcomments.splice(this.commentIndex(data), 1);
                    })
            },
            storeSubComment: function (data) {
                console.log(data);
                axios.post('/api/comment?api_token=' + this.user.api_token, data)
                    .then(({data}) => {
                        this.subcomments.push(data);
                    });
            },

            resetComment: function () {
                this.data.body = this.comment.body;
                this.edit_status = false;
            },
            //emiting to parrent
            saveComment: function () {
                this.edit_status = false;
                this.$emit('comment-update', {
                    'id': this.comment.id,
                    'body': this.data.body,
                });
            },
            deleteComment: function () {
                this.$emit('comment-delete', {
                    'id': this.comment.id
                });
            },

        },
        data: function () {
            return {
                edit_status: false,
                reply_status: false,
                data: {
                    body: this.comment.body,
                },
                subcomments: [],
            }
        },
    }
</script>
