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
                               :class="form.errors.title ? 'border-red-500' : 'border-gray-500'"
                               v-model="form.title"
                        >
                        <span class="text-xs italic text-red-700" v-if="form.errors.title" v-text="form.errors.title[0]"></span>

                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>

                        <textarea id="description" name="description"
                                  class="input bg-white border border-gray-300 rounded py-1 px-2 text-xm block w-full"
                                  :class="form.errors.description ? 'border-red-500' : 'border-gray-500'"
                                  rows="5"
                                  v-model="form.description"
                        ></textarea>

                        <span class="text-xs italic text-red-700" v-if="form.errors.description" v-text="form.errors.description[0]"></span>
                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Let's add some tasks</label>

                        <input type="text"
                               class="input bg-white border border-gray-300 rounded py-1 px-2 mb-2 text-xm block w-full"
                               placeholder="Task 1"
                               v-for="task in form.tasks"
                               v-model="task.body"
                        >

                        <button type="button" class="button text-xs mt-2 inline-flex items-center" @click="addTask">
                            Add New Task Field
                        </button>

                    </div>
                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="button-outlined mr-4 text-xs" @click="$modal.hide('new-project')">Cancel</button>

                <button class="button text-xs">Create Project</button>
            </footer>
        </form>

    </modal>
</template>

<script>
    import BirdboardForm from './BirdboardForm'

    export default {
        name: 'new-project-modal',

        data() {
            return {
               form: new BirdboardForm({
                   title: '',
                   description: '',
                   tasks: [
                       {body: ''},
                   ]
               }),
            }
        },

        methods: {
            addTask() {
                this.form.tasks.push({body: ''});
            },

            submit() {
                if(! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }

                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>
