<script>
    var filters = {
        all: function (todos) {
            return todos;
        },
        complete: function (todos) {
            return todos.filter(function (todo) {
                return todo.complete;
            });
        },
        incomplete: function (todos) {
            return todos.filter(function (todo) {
                return !todo.complete;
            });
        }
    };
    var STORAGE_KEY = 'vue-js-todo-P7oZi9sL';
    var todoStorage = {
        fetch: function () {
            var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            return todos;
        },
        save: function (todos) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(todos));
        }
    };

    export default {
        data() {
            return {
                name: 'aton-todo-list',
                inputVal: '',
                todos: todoStorage.fetch(),
                visibility: 'all'
            }
        },
        watch: {
            todos: {
                handler: function (todos) {
                    todoStorage.save(todos);
                }
            }
        },
        computed: {
            filteredTodos: function () {
                return filters[this.visibility](this.todos);
            }
        },
        methods: {
            addTodo: function (e) {
                e.preventDefault();
                if (this.inputVal) {
                    this.todos.push({
                        text: this.inputVal,
                        complete: false
                    });
                }
                this.inputVal = '';
            },
            toggleTodo: function (todo) {
                todo.complete = !todo.complete;
            },
            filterTodos: function (filter) {
                this.visibility = filter;
            },
            deleteTodo: function (index) {
                this.todos.splice(index, 1);
            }
        }
    }
</script>

<template>
    <v-flex xs4
    >
        <v-card>
            <form class="form" v-on:submit="addTodo">
                <input class="input form__input" v-model="inputVal"/>
                <button class="btn form__submit-btn" type="submit">Add</button>
            </form>
            <transition-group tag="ol" name="list" class="todo-list">
                <li
                        class="todo-list__item"
                        v-bind:class="{ complete: todo.complete }"
                        v-bind:key="index"
                        v-for="(todo, index) in filteredTodos">
                    <button
                            class="todo-list__item-content"
                            v-on:click="toggleTodo(todo)">
                        {{ todo.text }}
                    </button>
                    <button
                            class="btn todo-list__item-remove"
                            v-on:click="deleteTodo(index)">
                        <i class="fa" v-bind:class="[todo.complete ? 'fa-check' : 'fa-times']"></i>
                    </button>
                </li>
            </transition-group>
            <div class="filters">
                <button
                        class="btn filters__btn filters__btn--all"
                        v-on:click="filterTodos('all')">
                    All
                </button>
                <button
                        class="btn filters__btn filters__btn--complete"
                        v-on:click="filterTodos('complete')">
                    Complete
                </button>
                <button
                        class="btn filters__btn filters__btn--incomplete"
                        v-on:click="filterTodos('incomplete')">
                    Incomplete
                </button>
            </div>
        </v-card>
    </v-flex>

</template>

<style scoped>

    .card {
        min-width: 340px;
    }

    button {
        background: none;
        border: none;
        color: inherit;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
    }

    button:focus {
        outline: none;
    }

    button:hover {
        cursor: pointer;
    }

    .btn {
        font-size: 14px;
        margin: 0 .5em;
        border-radius: 2em;
        padding: 0.75em 1.5em;
        cursor: pointer;
        background: none;
        color: #2d7c58;
        border: 1px solid;
        letter-spacing: 1px;
        font-family: "Source Sans Pro", sans-serif;
        color: #4fc08d;
        border: #4fc08d 1px solid;
        -webkit-transition: 250ms ease-out;
        transition: 250ms ease-out;
    }

    .btn:hover, .btn:focus {
        color: #fff;
        background: #4fc08d;
    }

    .form {
        width: 100%;
        padding: 1.5rem 1rem 0 1rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .form__input {
        width: 100%;
        font-size: 14px;
        margin: 0 .5em;
        border-radius: 2em;
        padding: 0.75em 1.5em;
        background: none;
        font-family: "Source Sans Pro", sans-serif;
        border: #e3e3e3 1px solid;
        -webkit-transition: border 250ms ease-out;
        transition: border 250ms ease-out;
    }

    .form__input:focus {
        border: #4fc08d 1px solid;
        outline: none;
    }

    .todo-list {
        width: 100%;
        padding: 0 1rem;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .todo-list__item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: .5em;
        margin-bottom: .5em;
        border-radius: 3px;
        -webkit-transition: 200ms;
        transition: 200ms;
        color: #4fc08d;
    }

    .todo-list__item:last-child {
        margin-bottom: 0;
    }

    .todo-list__item.complete {
        color: lightgreen;
    }

    .todo-list__item.complete .todo-list__item-content:after {
        background: lightgreen;
    }

    .todo-list__item-content {
        position: relative;
    }

    .todo-list__item-content:after {
        content: "";
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        height: 1px;
        background: #4fc08d;
        -webkit-transition: 250ms ease-out;
        transition: 250ms ease-out;
        -webkit-transform-origin: center;
        transform-origin: center;
        -webkit-transform: scalex(0);
        transform: scalex(0);
    }

    .todo-list__item-content:hover:after, .todo-list__item-content:focus:after {
        -webkit-transform: scalex(1);
        transform: scalex(1);
    }

    .todo-list__item-remove {
        margin-left: .5em;
        background: none;
        border: 1px solid;
        color: inherit;
        padding: 0;
        line-height: 1;
        width: 2em;
        height: 2em;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 80%;
    }

    .filters {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: distribute;
        justify-content: space-around;
        padding: 0 1rem 1.5rem 1rem;
    }
</style>

