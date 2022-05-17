<template>
    <div class="card shadow-lg mb-5 bg-body rounded">
        <div class="card-header">
            your links
        </div>
        <div class="card-body">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th scope="col">title</th>
                    <th scope="col">shortened</th>
                    <th scope="col">origin</th>
                    <th scope="col">date</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="link in links" :key="link.id">
                    <td>{{ link.title }}</td>
                    <td><a :href="link.short_path" target="_blank">{{ link.short_path }}</a></td>
                    <td><a :href="link.full_path" target="_blank">{{ link.full_path }}</a></td>
                    <td>{{ link.created_at  | formatDate }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <button
                                type="button"
                                class="btn btn-outline-dark"
                                data-bs-toggle="modal"
                                :data-bs-target="'#editLink' + link.id"
                                @click="title = link.title"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-pencil"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                </svg>
                                <span class="visually-hidden">Button</span>
                            </button>
                            <!-- Modal -->
                            <div
                                class="modal fade"
                                :id="'editLink' + link.id"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'editLink' + link.id + 'Label'">
                                                edit link title
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :id="'link-title-' +  + link.id"
                                                    placeholder="link title"
                                                    v-model="title"
                                                >
                                                <label :for="'link-title-' +  + link.id">link title</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                close
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-outline-dark"
                                                @click="update(link.id)"
                                                data-bs-dismiss="modal"
                                            >
                                                save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button
                                type="button"
                                class="btn btn-outline-dark"
                                data-bs-toggle="modal"
                                :data-bs-target="'#deleteLink' + link.id"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-trash"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path
                                        fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                                <span class="visually-hidden">Button</span>
                            </button>
                            <!-- Modal -->
                            <div
                                class="modal fade"
                                :id="'deleteLink' + link.id"
                                tabindex="-1"
                                :aria-labelledby="'#deleteLink' + link.id + 'Label'"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" :id="'deleteLink' + link.id + 'Label'">delete link</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            are you sure want to remove the link:
                                            <br>
                                            {{ link.title }}
                                            <br>
                                            <a :href="link.short_path" target="_blank">{{ link.short_path }}</a>
                                            <br>
                                            <a :href="link.full_path" target="_blank">{{ link.full_path }}</a>
                                            <br>
                                            ?
                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                close
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-outline-dark"
                                                data-bs-dismiss="modal"
                                                @click="destroy(link.id)"
                                            >
                                                delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted text-start text-decoration-none">
            <router-link to="/" class="text-decoration-none text-dark">&#8592; create links</router-link>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import router from "../../router";

export default {
    data() {
        return {
            links: [],
            title: null,
        }
    },

    created() {
        let self = this
        axios.get('/links')
            .then(res => {
                res.data.forEach(function (objLink) {
                    self.links.push(objLink)
                })
            })
    },

    filters: {
        formatDate: strDate => moment(strDate).format('MM/DD/YYYY hh:mm'),
    },

    methods: {
        update(linkId) {
            axios.patch('/links/' + linkId, {title: this.title})
                .then(() => {
                    this.$router.go()
                })
        },
        destroy(linkId) {
            axios.delete('/links/' + linkId)
                .then(() => {
                    this.$router.go()
                })
        },
    }
}
</script>
