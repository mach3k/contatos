import React, { Component } from 'react'
import * as yup from 'yup'
import { ErrorMessage, Formik, Form as FormikForm, Field } from 'formik'

const validations = yup.object().shape({
    user: yup.string().email().required(),
    password: yup.string().min(8).required()
})

class YupFormik extends Component {


    render() {
        return (
        <>
            <div className="modal fade" id={this.props.id} tabIndex="-1" role="dialog" aria-labelledby="modalTelefoneLabel" aria-hidden="true">
                <div className="modal-dialog modal-default" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title" id="modalTelefoneLabel">Número de telefone</h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <Formik initialValues={initialValues} onSubmit={handleSubmit} validationSchema={validations}>
                                <FormikForm className="Form">
                                    <div className="row">
                                        <div className="col-sm-3">
                                            <div className="form-group">
                                                <label htmlFor="ddd">DDD</label>
                                                <Field className="form-control" name="ddd" placeholder="(     )" type="number"/>
                                                <ErrorMessage className="error invalid-feedback" component="span" name="ddd"/>
                                            </div>
                                        </div>

                                        <div className="col-sm-6">
                                            <div className="form-group">
                                                <label htmlFor="numero">Número</label>
                                                <input type="text" className="form-control" name="numero" maxLength="15" placeholder="" autoFocus required
                                                value={this.state.numero ? this.state.numero : ''} onChange={(e) => this.numeroHandler(e)} />
                                            </div>
                                        </div>

                                        <div className="col-sm-3">
                                            <div className="form-group">
                                                <label htmlFor="ramal">Ramal</label>
                                                <input type="text" className="form-control" name="ramal" maxLength="10" placeholder=""
                                                value={this.state.ramal ? this.state.ramal : ''} onChange={(e) => this.ramalHandler(e)} />
                                            </div>
                                        </div>
                                    </div>
                                    <div className="Form-Group">
                                        
                                    </div>
                                    <div className="Form-Group">
                                        <Field className="Form-Field" name="password" placeholder="Password" type="password"/>
                                        <ErrorMessage className="Form-Error" component="span" name="password"/>
                                    </div>
                                    <button className="Form-Btn" type="submit">Login</button>
                                </FormikForm>
                            </Formik>

                            <div className="row">
                                <div className="col-sm-6" data-select2-id="1">
                                    <div className="form-group">
                                        <label htmlFor="tipo_telefone_id">Tipo</label>
                                        <Select
                                            className="basic-multi-select"
                                            classNamePrefix="select"
                                            value={this.state.tipoTelefoneSel}
                                            styles={customStyles}
                                            placeholder="Selecione um tipo"
                                            isClearable={true}
                                            isSearchable={true}
                                            name="tipo_telefone_id"
                                            options={this.state.tiposTelefone}
                                            onChange={this.tipoTelefoneHandler}
                                            isMulti
                                        />
                                    </div>
                                </div>

                                <div className="col-sm-6" data-select2-id="2">
                                    <div className="form-group">
                                        <label htmlFor="operadora_id">Operadora</label>
                                        <Select
                                            className="basic-single"
                                            classNamePrefix="select"
                                            value={this.state.operadoraSel}
                                            styles={customStyles}
                                            placeholder="Selecione a operadora"
                                            isClearable={true}
                                            isSearchable={true}
                                            name="operadora_id"
                                            options={this.state.operadoras}
                                            onChange={this.operadoraHandler}
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="form-group">
                                        <label htmlFor="observacao">Observação</label>
                                        <textarea name="observacao" className="form-control" rows="3" maxLength="300" placeholder=""
                                        value={this.state.observacao ? this.state.observacao : ''} onChange={(e) => this.observacaoHandler(e)} />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="modal-footer justify-content-between">
                            <button type="button" className="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" className="btn btn-outline-primary" data-dismiss="modal"
                            onClick={() => { this.handleSave() }} id="salvarTelefone">Salvar</button>
                            <button type="button" className="btn btn-primary" onClick={() => { this.handleClick() }} id="verState">Ver State</button>
                        </div>
                    </div>
                </div>
            </div>
        </>
        )
    }
}
export default YupFormik;