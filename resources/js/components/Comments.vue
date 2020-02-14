<template>
    <div class="comment-container">
        <div class="w-100">
            <comment v-for="comment in comments"
                     :key="comment.id"
                     :user="user"
                     :comment="comment"
                     @comment-update="updateComment($event)"
                     @comment-delete="deleteComment($event)"
                     @comment-create="storeComment($event)"
            ></comment>
        </div>
        <new-comment v-if="user.id"
                     @comment-create="storeComment($event)"
                     :user="user"
        ></new-comment>
    </div>
</template>

<script>
    import comment from './Comment';

    export default {
        name: 'comments-container',
        components: {
            comment
        },
        created() {
            this.fetchComment();
        },
        props: {
            user: {
                type: [Object, Boolean],
            },
        },
        methods: {
            commentIndex: function (data) {
                return this.comments.findIndex((element) => {
                    return element.id === data.id;
                });
            },
            fetchComment: function () {
                data: {
                    parrent: null
                }
                axios.get('/api/comment')
                    .then(({data}) => {
                        this.comments = data;
                        console.log(data)
                    })
            },
            updateComment: function (data) {
                axios.put('/api/comment/' + data.id + '?api_token=' + this.user.api_token, data)
                    .then(({}) => {
                        this.comments[this.commentIndex(data)].body = data.body;
                    })
            },
            deleteComment: function (data) {
                axios.delete('/api/comment/' + data.id + '?api_token=' + this.user.api_token, data)
                    .then(() => {
                        this.comments.splice(this.commentIndex(data), 1);
                    })
            },
            storeComment: function (data) {
                console.log(data);
                axios.post('/api/comment?api_token=' + this.user.api_token, data)
                    .then(({data}) => {
                        this.comments.push(data);
                    });
            }
        },
        data: function () {
            return {
                comments: []
            }
        },
    }
</script>
