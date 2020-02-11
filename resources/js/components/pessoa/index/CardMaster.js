import React, { Component } from 'react';
import BtnPesquisar from './BtnPesquisar';
import PessoasList from './PessoasList';

class CardMaster extends Component {
    render() {
        return (
            <div className="card card-solid">
                <div className="card-header">
                    <div className="row">
                    <div className="col-sm-4">
                        <BtnPesquisar />
                    </div>
                    <div className="col-sm-4" />
                    <div className="col-sm-4">
                        <div className="float-right">
                        <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#modalNovo">Novo registro</button>
                        </div>
                    </div>
                    </div>
                </div> {/* /.card-header */}

                <PessoasList pessoas={this.props.pessoas}/>

                <div className="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                    {'{'}!! $registros-&gt;links() !!{'}'}
                    </nav>
                </div> {/* /.card-footer */}
            </div>
        );
    }
}

export default CardMaster;
