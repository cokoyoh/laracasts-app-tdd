<template>
    <modal name="new-project" classes="p-10 card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>

                        <input type="text" id="title" name="title"
                               class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                               :class="errors.title ? 'border-red-500' : 'border-gray-500'"
                               v-model="form.title"
                        >
                        <span class="text-xs italic text-red-700" v-if="errors.title" v-text="errors.title[0]"></span>

                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>

                        <textarea id="description" name="description"
                                  class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                                  :class="errors.description ? 'border-red-500' : 'border-gray-500'"
                                  rows="5"
                                  v-model="form.description"
                        ></textarea>

                        <span class="text-xs italic text-red-700" v-if="errors.description" v-text="errors.description[0]"></span>
                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Let's add some tasks</label>

                        <input type="text"
                               class="input bg-white border border-gray-300 rounded py-1 px-2 mb-2 text-xm block w-full"
                               placeholder="Task 1"
                               v-for="task in form.tasks"
                               v-model="task.value"
                        >

                        <button class="button text-xs mt-2 inline-flex items-center" @click="addTask">
                            Add New Task Field
                        </button>

                    </div>
                </div>
            </div>

            <footer class="flex justify-end">
                <button class="button-outlined mr-4 text-xs" @click="$modal.hide('new-project')">Cancel</button>

                <button class="button text-xs">Create Project</button>
            </footer>
        </form>

    </modal>
</template>

<script>
    export default {
        name: 'new-project-modal',

        data() {
            return {
               form: {
                   title: '',
                   description: '',
                   tasks: [
                       {value: ''},
                   ]
               },
                errors: {}
            }
        },

        methods: {
            addTask() {
                this.form.tasks.push({value: ''});
            },

            submit() {
                axios.post('/projects', this.form)
                    .then((response) => location = response.data.message)
                    .catch((error) => this.errors = error.response.data.errors);
            }
        }
    }
</script>
