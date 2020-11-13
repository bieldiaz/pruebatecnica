import React, { Component } from 'react'
import '../styles/app.css'
import "bootstrap/dist/css/bootstrap.css";
import TableContent from './TableContent'
import Searcher from './Searcher'
class Main extends Component {
    render() {
        return (
            <div className="container-fluid">
                <h4 className="text-center mb-5 mt-5">Machines by Biel</h4>
                <Searcher />
            </div>
        );
    }
}

export default Main;
