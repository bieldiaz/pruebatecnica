import React, { Component } from 'react'
import '../styles/app.css'
import { Table, Alert } from 'react-bootstrap'

class TableContent extends Component {
    constructor(props) {
        super(props);
        this.state = {
            machines: [],
            search: props.machinesSearch
        }
    }

    componentDidMount() {
        fetch('http://127.0.0.1:8000/machines')
            .then((response) => {
                return response.json()
            })
            .then((json) => {
                this.setState({
                    machines: json.data
                })
            })
    }

    render() {
        //console.log(this.props.machinesSearch)
        if (!this.props.machinesSearch) {
            return (
                <Alert variant="danger">
                    <Alert.Heading className="text-center">MACHINES NOT FOUND</Alert.Heading>
                </Alert>
            )
        } else {
            return (
                <div>
                    <Table striped bordered hover variant="dark" >
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Brand</th>
                                <th>Manufacturer</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Images</th>
                            </tr>
                        </thead>
                        {
                            this.state.machines.map(machine => (
                                <tr key={machine.id}>
                                    <td>{machine.id}</td>
                                    <td>{machine.brand}</td>
                                    <td>{machine.manufacturer}</td>
                                    <td>{machine.model}</td>
                                    <td>{machine.price}</td>
                                    <td>{machine.images}</td>
                                </tr>
                            ))
                        }
                    </Table>
                </div>
            )
        }
    }
}

export default TableContent;
