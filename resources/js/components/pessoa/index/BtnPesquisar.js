import React, { Component } from 'react';

class BtnPesquisar extends Component {
    render() {
        return (
            <div className="input-group mb-3">
                <input name="search" type="text" className="form-control" placeholder="Procurar..." />
                <div className="input-group-append">
                    <button type="button" className="btn btn-default"><i className="fas fa-search" /></button>
                </div>
            </div>
        );
    }
}

export default BtnPesquisar;
