import React from 'react'
import { render } from 'react-dom'
import {Component} from 'react'
import axios from 'axios';

class TodoList extends Component {


    constructor(){

        super();
       
        this.inputTodo = React.createRef();

        this.state = {
            
            TODO: []
        
        }

    }


    LoadToDoList(){

        axios.get(`http://localhost:8000/Todo`)
        .then(res => {
          const TODO = res.data.data;
          this.setState({ TODO });
        })

    }

    AddTodoList(){

      console.log(this.refs);

      if (this.inputTodo !== null) {
        console.log(this.inputTodo.current.value);
        
        const formData = new FormData();
        formData.append('todo', this.inputTodo.current.value);

        axios.post('http://localhost:8000/Todo', formData)
        .then(res => {

          this.LoadToDoList();

        })

        // var input = this.inputTodo.current;
        // console.log(input);
        // var inputValue = input.value;
        // alert("Input is", inputValue);
      }

    }

    deleteTodo(id_todo){

      axios.delete(`http://localhost:8000/Todo?id_todo=`+id_todo)
      .then(res => {
          
          this.LoadToDoList();

        })

    }

    render() {
      return (
        <div>
          <table class="table">
            <tbody>

            { this.state.TODO.map(TODO => <tr><td class="text-center">{TODO.todo}</td><td class="text-center"><button class="btn btn-dark" onClick={() => this.deleteTodo(TODO.id_todo)} >Supprimer</button></td></tr>)}

            </tbody>
          </table>

        <button onClick={this.LoadToDoList.bind(this)} class="btn btn-dark mt-2 mr-3">Charger la todolist</button><br></br>
        <input type="text" ref={this.inputTodo} class="mr-3" />
        <button onClick={this.AddTodoList.bind(this)} class="btn btn-dark mt-2">Ajouter a la todolist</button>
        </div>
      );
    }
  }
  
  render(
    <TodoList/>,
    document.getElementById('todo')
  );