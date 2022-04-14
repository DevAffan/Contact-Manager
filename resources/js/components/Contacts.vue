<template>
<div>
<h1>Contacts</h1>
<form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" v-model="contact.name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" v-model="contact.email">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" v-model="contact.phone">
    </div>
    <div class="form-group">
        <button class="btn btn-primary mt-2" v-show="!edit" type="submit">Create New</button>
        <button class="btn btn-warning mt-2" v-show="edit" type="submit">Update</button>
    </div>
</form>
<h1>Contacts</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="contact in list">
            <td>{{ contact.name }}</td>
            <td>{{ contact.email }}</td>
            <td>{{ contact.phone }}</td>
            <td>
                <button class="btn btn-primary" @click="showContact(contact)">Edit</button>
                <button class="btn btn-danger" @click="deleteContact(contact.id)">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
</div>
</template>


<script>
export default {
    // name: 'Contacts',
    data: function () {
        return {
            contact: {
                id: '',
                name: '',
                email: '',
                phone: ''
            },
            edit: false,
            list: [],
    }
    },
    mounted: function () {
        console.log('Contacts mounted');
        this.fetchContacts();
    },

    methods:{

            fetchContacts: function () {
                console.log('fetching contacts');

                axios.get('/api/contacts')
                .then(response => {
                console.log(response.data);
                this.list = response.data;
                })
                .catch(error => {
                console.log(error);
                });
            },

            createContact: function(){

                console.log('createContact');
                let self = this;
                let url = '/api/contact/store';
                let params = Object.assign({}, self.contact);

                axios.post(url, params)
                    .then(function () {
                        self.contact.name = '';
                        self.contact.email = '';
                        self.contact.phone = '';
                        self.fetchContacts();
                        self.edit = false;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            showContact: function(contact){
                console.log('showContact' + contact.id);
                let self = this;
                let url = '/api/contact/' + contact.id;
                axios.get(url)
                    .then(function (response) {
                        self.contact = response.data;
                        self.edit = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            updateContact: function(id){
                console.log('updateContact' + id);
                let self = this;
                let url = '/api/contact/' + id;
                let params = Object.assign({}, self.contact);
                axios.patch(url, params)
                    .then(function () {
                        self.contact.name = '';
                        self.contact.email = '';
                        self.contact.phone = '';
                        self.fetchContacts();
                        self.edit = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            deleteContact: function(id){
                console.log('deleteContact' + id);
                let self = this;
                let url = '/api/contact/' + id;
                axios.delete(url)
                    .then(function () {
                        self.fetchContacts();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
    }
}
</script>
