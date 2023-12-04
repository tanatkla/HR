<html>

<head>
    <style>
        .chat-container {
            width: 1000px;
            height: 500px;
            border: 1px solid gray;
            margin: auto;
            padding: 10px;
        }

        .chat-header {
            background-color: lightgray;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .chat-messages {
            height: 400px;
            overflow-y: scroll;
        }

        .chat-message {
            display: flex;
            margin-bottom: 10px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 25px;
        }

        .message-box {
            width: 750px;
            background-color: lightblue;
            padding: 10px;
            border-radius: 10px;
            margin-left: 150px;
            word-wrap: break-word;
    overflow-wrap: break-word;
    overflow: auto;
        }

        .message-box-other {
            width: 400px;
            background-color: rgb(151, 151, 247);
            padding: 10px;
            border-radius: 10px;
            margin-right: 150px;
        }

        .username {
            font-weight: bold;
        }

        .message-input {
            width: 100%;
            height: 50px;
            margin-top: 10px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .send-button {
            width: 100px;
            height: 50px;
            background-color: lightgreen;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            float: right;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="chat-container">
            <div class="chat-header">
                {{-- Chat Application --}}
            </div>
            <div class="chat-messages" ref="chatBox">
                <div class="chat-message" v-for="message in messages">
                    <template v-if="message.user_id != {{Auth::user()->id}}">
                        <img class="avatar"
                            :src="'https://i.natgeofe.com/n/4f5aaece-3300-41a4-b2a8-ed2708a0a27c/domestic-dog_thumb_3x2.jpg'">
                        <div class="message-box-other">
                            <div class="username">
                                @{{ message.username }}
                            </div>
                            <div class="message">
                                @{{ message.message }}
                                @{{ messages.message }}
                            </div>
                        </div>
                    </template>
                    <template v-else-if="message.user_id == {{Auth::user()->id}}">
                        
                        <div class="message-box">
                            <div class="username">
                                @{{ message.id }}
                                {{-- @{{ message.username }} --}}
                                {{ Auth::user()->name }}
                            </div>
                            <div class="message">
                                @{{ message.message }}
                                {{-- @{{ messages.message }} --}}
                            </div>
                        </div>
                        <img class="avatar"
                        :src="'https://i.natgeofe.com/n/548467d8-c5f1-4551-9f58-6817a8d2c45e/NationalGeographic_2572187_square.jpg'">
                    </template>

                </div>
            </div>
            <div class="message-input-container">
                <input class="message-input" v-model="newMessage" placeholder="Enter your message here..." v-on:keyup.enter="sendMessage">
                <button class="send-button"   @click="sendMessage">Send</button>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var data = {!! json_encode($data) !!};
    // console.log(data);
    new Vue({
        el: '#app',
        data: {
            messages: [],
            newMessage: ''
        },
        created: function() {
            this.fetchMessages();
            

        },
        methods: {
            fetchMessages: function() {
                axios.get('/chat-messages-get')
                    .then(response => {
                        // console.log(response.data);
                        this.messages = response.data;
                        this.scrollToBottom();

                    })
                    .catch(error => {
                        // console.log('555');
                        console.error(error);
                    });
            },
            scrollToBottom() {
                this.$nextTick(() => {
                    this.$refs.chatBox.scrollTop = this.$refs.chatBox.scrollHeight;
                });
            },
            sendMessage: function() {
                axios.post('/chat-messages-send', {
                        username: 'User',
                        message: this.newMessage
                    })
                    .then(response => {
                        this.newMessage = '';
                        //   console.log(response.data.message);
                        this.fetchMessages();
                        this.scrollToBottom();

                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    });
</script>

</html>
