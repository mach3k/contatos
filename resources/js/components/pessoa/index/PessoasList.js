import React, { Component } from 'react';
import Pessoa from './Pessoa';

class PessoasList extends Component {
    render() {
        return (
            <div className="card-body pb-0">
                <div className="row d-flex align-items-stretch">
                    {this.props.registros.map((pessoa) => {
                        return <Pessoa pessoa={pessoa} key={pessoa.id} />
                    })}
                </div>
            </div>
        );
    }
}

export default PessoasList;
