<template>
    <div>
        <div v-if="errors" class="alert alert-danger" role="alert">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="(error, index) in errors" :key="index"><div v-html="error"></div></li>
            </ul>
        </div>
        <div class="card shadow-lg mb-5 bg-body rounded">
            <div class="card-header">
                hello!
            </div>
            <div class="card-body">
                <h5 class="card-title">shorten your link</h5>
                <div class="form-floating mb-3">
                    <input type="url" class="form-control" placeholder="enter your link" id="link" v-model="full_path" required>
                    <label for="link">enter your link</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="title" placeholder="link title" v-model="title">
                    <label for="floatingInput">link title</label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-dark" type="button" @click="create">save</button>
                </div>
            </div>
            <div class="card-footer text-muted text-end">
                <router-link to="/links" class="text-decoration-none text-dark">your links &#8594;</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import router from "../../router";

export default {
    data() {
        return {
            title: null,
            full_path: null,
            errors: null,
        }
    },

    methods: {
        create() {
            axios.post('/links', {title: this.title, full_path: this.full_path})
                .then(res => {
                    if(null !== res.data.error) {
                        this.errors = res.data.error
                    } else {
                        router.push({name: 'links.index'})
                    }
                })
        }
    }
}
</script>
<style>
.list-group-item {
    background-color: unset;
}
</style>
