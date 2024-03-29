<template>
    <div>
        <div class="row">
            <div class="col-4">
                <h3>Users list</h3>
                <ul class="nav flex-column">
                    <li v-for="user in users"
                        class="nav-link"
                        :key="user.id"
                        @click="openChat(user.id)"
                        :class="{'font-weight-bold': chatUserID === user.id}">
                        <a href="#">{{ user.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-8">
                <div v-show="chatOpen && !loadingMessages">
                    <div class="row" style="max-height: 50vh; overflow: scroll; padding-bottom: 50px" ref="messageBox">
                        <div class="col-12" v-for="message in messages" :key="message.id"
                             :class="{'text-right': message.sender_id !== chatUserID}">
                            <small>{{ message.sender.name }} at {{ message.created_at }}</small>
                            <p>
                                {{ message.message }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text"
                                       class="form-control"
                                       placeholder="New message"
                                       aria-label="New message"
                                       aria-describedby="button-addon2" v-model="newMessage">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="button-addon2"
                                            @click="sendMessage">
                                        Send message
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-show="loadingMessages">
                    <p>Loading messages... Please wait</p>
                </div>
                <div v-show="!chatOpen && !loadingMessages">
                    <p>No chat room is open. Please click on user to start a conversation</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ChatApplication',
    data: () => {
      return {
        users: [],
        messages: [],
        chatOpen: false,
        chatUserID: null,
        loadingMessages: false,
        newMessage: ''
      }
    },
    created () {
      let app = this
      app.loadUsers()
    },
    watch: {
      messages: function () {
        let element = this.$refs.messageBox
        element.scrollTop = element.scrollHeight
      }
    },
    methods: {
      openChat (userID) {
        let app = this
        if (app.chatUserID !== userID) {
          app.chatOpen = true
          app.chatUserID = userID

          // Start socket.io listener
          Echo.channel('laravel_database_newMessage-' + app.chatUserID + '-' + app.$root.userID)
            .listen('MessageSent', (data) => {
              if (app.chatUserID) {
                app.messages.push(data.message)
              }
            })
          // End socket.io listener
          app.loadMessages()
        }
      },
      loadUsers () {
        let app = this
        axios.get('users')
          .then((resp) => {
            app.users = resp.data
          })
      },
      loadMessages () {
        let app = this
        app.loadingMessages = true
        app.messages = []
        axios.post('messages', {
          sender_id: app.chatUserID
        }).then((resp) => {
          app.messages = resp.data
          app.loadingMessages = false
        })
      },
      sendMessage () {
        let app = this
        if (app.newMessage !== '') {
          axios.post('messages/send', {
            sender_id: app.$root.userID,
            receiver_id: app.chatUserID,
            message: app.newMessage
          }).then((resp) => {
            app.messages.push(resp.data)
            app.newMessage = ''
          })
        }
      }
    }
  }
</script>
