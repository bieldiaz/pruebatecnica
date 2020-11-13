import React, { Component, useState } from 'react'

import { InputGroup, FormControl } from 'react-bootstrap';
import TableContent from './TableContent';


function Searcher() {

    const [search, setSearch] = useState("");

    const handleChange = e => {
        setSearch(e.target.value)
    }

    return (
        <div className="container">
            <InputGroup className="mb-3">
                <InputGroup.Prepend>
                    <InputGroup.Text id="basic-addon1">Type the machine brand</InputGroup.Text>
                </InputGroup.Prepend>
                <FormControl
                    placeholder="Search"
                    aria-label="Machine"
                    aria-describedby="basic-addon1"
                    onChange={handleChange}
                />
            </InputGroup>
            <TableContent machinesSearch={search} />
        </div>
    )
}
export default Searcher;
