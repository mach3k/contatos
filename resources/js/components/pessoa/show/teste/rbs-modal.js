import React, { useState, useEffect, Component } from "react";
import { Modal, Button } from 'react-bootstrap';
import { useForm, Controller } from "react-hook-form";
// import { RHFInput } from 'react-hook-form-input';
import Select from 'react-select';
import axios from 'axios';
// import moment from 'moment';
import { parseISO, format } from 'date-fns';
import DatePicker from "react-datepicker";
import 'react-datepicker/dist/react-datepicker.css';
import './rbs-modal.css';
// import { DatePicker } from 'antd';
// import 'antd/dist/antd.css';

const customStyles = {
    width: '100%'
}

const defaultValues = {
    ddd: "",
    numero: "",
    ramal: "",
    tipoTelefoneSel: null,
    operadoraSel: null
};

const ModalTelefone = (props) => {
    const { register, handleSubmit, errors, control, setValue, reset, getValues } = useForm();
    // const { register, handleSubmit, errors, control, setValue, getValues } = useForm();

    // function onSubmit(data) {
    //     console.log("Data submitted: ", data);
    // }

    const [tipoTelefoneSel, setTipoTelefoneSel] = useState(null);
    const [tiposTelefone, setTiposTelefone] = useState({});
    const [operadoraSel, setOperadoraSel] = useState(null);
    const [operadoras, setOperadoras] = useState({});

    const [startDate, setStartDate] = useState(new Date());
    const [outraData, setOutraData] = useState(new Date());
    // const [startDate, setStartDate] = useState(moment.now());

    // const [focus, setFocus] = useState(false);

    useEffect(() => {
        getTiposTelefone();
        getOperadoras();
        // reset(defaultValues);
        // setTipoTelefoneSel(null);
        // setOperadoraSel(null);
        // console.log("useEffect props", props);
        // console.log("useEffect startDate", startDate);
    }, []);

    // function formatarCpf(cpf){
    //     cpf = cpf.replace(/\D/g,"");
    //     cpf = cpf.replace(/(\d{3})(\d)/,"$1.$2");
    //     cpf = cpf.replace(/(\d{3})(\d)/,"$1.$2");
    //     cpf = cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    //     return cpf;
    // }

    // function formatarData(data){
    //     data = data.replace(/\D/g,"");
    //     data = data.replace(/(\d{2})(\d)/,"$1/$2");
    //     data = data.replace(/(\d{2})(\d)/,"$1/$2");
    //     return data;
    // }

    useEffect(() => {
        // console.log("useEffect props.registro", props);
        // const values = getValues();
        // console.log("values effect.registro", values);
        if (props.show) {
            if (props.registro !== undefined && props.registro !== null) {
                try {
                    console.log("props.registro != null)");
                    const tipo = props.registro.tipo !== undefined && props.registro.tipo !== null
                        ? { value: props.registro.tipo.id, label: props.registro.tipo.nome }
                        : null;
                    const operadora = props.registro.operadora !== undefined && props.registro.operadora !== null
                        ? { value: props.registro.operadora.id, label: props.registro.operadora.nome }
                        : null;
                    setValue([
                        { ddd: props.registro.ddd },
                        { numero: props.registro.numero },
                        { ramal: props.registro.ramal },
                        { tipoTelefoneSel: tipo },
                        { operadoraSel: operadora }
                    ]);
                    setTipoTelefoneSel(tipo);
                    setOperadoraSel(operadora);
                } catch (error) {
                    console.log("error: ", error);
                }

            } else {
                try {
                    console.log("props.registro == null)");
                    reset(defaultValues);
                    setTipoTelefoneSel(null);
                    setOperadoraSel(null);
                } catch (error) {
                    console.log("error: ", error);

                }
            }
        }
    }, [props.show]);

    // useEffect(() => {
    //     if (props.show) {
    //         const input = document.querySelector("ddd");
    //         input.focus();
    //     }
    // }, [props.show]);

    function getTiposTelefone() {
        // console.log(`${this.state.baseUrl}/api/listatipostelefone`);

        axios.get(`${props.baseUrl}/api/listatipostelefone`)
            .then(response => {

                const registros = response.data.map((item) => {
                    return { value: item.id, label: item.nome };
                });

                setTiposTelefone(registros);
            })
            .catch(error => {
                console.log('deu merda na busca de tipos de telefone', error);
            });
    }

    function getOperadoras() {

        axios.get(`${props.baseUrl}/api/listaoperadoras`)
            .then(response => {

                const registros = response.data.map((item) => {
                    return { value: item.id, label: item.nome };
                });

                setOperadoras(registros);
            })
            .catch(error => {
                console.log('deu merda na busca de operadoras', error);
            });
    }

    function onSubmit(data) {

        const item = {
            id: props.registro ? props.registro.id : null,
            pessoa_id: props.pessoa_id,
            tipo_telefone_id: tipoTelefoneSel != null ? tipoTelefoneSel.value : null,
            numero: data.numero,
            ddd: data.ddd,
            ramal: data.ramal,
            // observacao: data.observacao,
            operadora_id: operadoraSel != null ? operadoraSel.value : null,
        };

        console.log('Item do modal: ');
        console.log(item);

        axios.post(`${props.baseUrl}/api/telefone`, item)
            .then(response => {

                console.log("Retorno do salvar...");
                console.log(response.data);

                try {
                    if (item.id) {
                        props.updateListItem(response.data);
                    } else {
                        props.saveModalDetails(response.data);
                    }

                    props.handleClose();

                } catch (error) {
                    console.log(error);
                }
                // console.log(response.data.pessoa_id);
            })
            .catch(error => {
                console.log('deu merda ao salvar');
            });
    }


    return (
        <>
            <Modal show={props.show} onHide={props.handleClose}>
                <Modal.Header closeButton>
                    <Modal.Title>Número de telefone</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <form id="formTelefone" onSubmit={handleSubmit(onSubmit)} noValidate>
                        <div className="row">
                            <div className="col-sm-3">
                                <div className="form-group">
                                    <label htmlFor="ddd">DDD</label>
                                    <input type="text" className="form-control"
                                        name="ddd" maxLength="3" placeholder="(     )"
                                        ref={register({
                                            pattern: {
                                                value: /^\d+$/,
                                                message: "Apenas números",
                                            },
                                        })} autoFocus />
                                    {errors.ddd && <small className="text-danger">{errors.ddd.message}</small>}
                                </div>
                            </div>

                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="numero">Número</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        name="numero"
                                        maxLength="15"
                                        ref={register({
                                            required: "Informação necessária",
                                            pattern: {
                                                value: /^\d+$/,
                                                message: "Informe apenas números",
                                            },
                                        })}
                                    />
                                    {errors.numero && <small className="text-danger">{errors.numero.message}</small>}
                                </div>
                            </div>

                            <div className="col-sm-3">
                                <div className="form-group">
                                    <label htmlFor="ramal">Ramal</label>
                                    <input type="text" className="form-control"
                                        name="ramal" maxLength="10" placeholder=""
                                        ref={register()} />
                                </div>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-sm-6" data-select2-id="1">
                                <div className="form-group">
                                    <label htmlFor="tipo_telefone_id">Tipo</label>
                                    <Controller
                                        as={<Select />}
                                        options={tiposTelefone}
                                        name="tipoTelefoneSel"
                                        styles={customStyles}
                                        isClearable
                                        isSearchable
                                        placeholder="Selecione um tipo"
                                        control={control}
                                        onChange={([selected]) => {
                                            setTipoTelefoneSel(selected);
                                            setValue("tipoTelefoneSel", selected);
                                            const obj = selected != null ? { value: selected.value, label: selected.label } : null;
                                            return obj;
                                        }}
                                        defaultValue={tipoTelefoneSel}
                                        rules={{ required: "Informação necessária" }}
                                    />
                                    {errors.tipoTelefoneSel && <small className="text-danger">{errors.tipoTelefoneSel.message}</small>}
                                </div>
                            </div>

                            <div className="col-sm-6" data-select2-id="2">
                                <div className="form-group">
                                    <label htmlFor="operadora_id">Operadora</label>
                                    {/* <Select
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
                                    /> */}
                                    <Controller
                                        as={<Select />}
                                        options={operadoras}
                                        name="operadoraSel"
                                        styles={customStyles}
                                        isClearable
                                        isSearchable
                                        placeholder="Selecione uma operadora"
                                        control={control}
                                        onChange={([selected]) => {
                                            // console.log("selected", selected);
                                            setOperadoraSel(selected);
                                            setValue("operadoraSel", selected);
                                            const obj = selected != null ? { value: selected.value, label: selected.label } : null;
                                            return obj;
                                        }}
                                        defaultValue={operadoraSel}
                                    />
                                </div>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="startDate">DatePicker testes</label>
                                    <div className="input-group">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text"><i className="far fa-calendar-alt"></i></span>
                                        </div>
                                        <div className="form-control float-right">
                                            <Controller
                                                as={
                                                    <DatePicker
                                                        dateFormat="dd/MM/yyyy"
                                                        selected={startDate}
                                                    // onChange={setStartDate}
                                                    />}
                                                name="startDate"
                                                control={control}
                                                className="m-0 p-0 border-0 transparente"
                                                rules={{ required: "Informação necessária" }}
                                                onChange={([selected]) => {
                                                    // props.onChange
                                                    setStartDate(selected);
                                                    console.log(selected);
                                                    return selected;
                                                }}
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="col-sm-6">
                                <div className="form-group">
                                    <label htmlFor="outraData">DatePicker funcionando</label>
                                    <div className="input-group">
                                        <div className="input-group-prepend">
                                            <span className="input-group-text"><i className="far fa-calendar-alt"></i></span>
                                        </div>
                                        <div className="form-control float-right">
                                            <Controller
                                                as={
                                                    <DatePicker
                                                        dateFormat="dd/MM/yyyy"
                                                        selected={outraData}
                                                    // onChange={setOutraData}
                                                    />}
                                                name="outraData"
                                                control={control}
                                                className="m-0 p-0 border-0 transparente"
                                                rules={{ required: "Informação necessária" }}
                                                onChange={([selected]) => {
                                                    // props.onChange
                                                    setOutraData(selected);
                                                    console.log("selected: ", selected);
                                                    return selected;
                                                }}
                                                defaultValue={outraData}
                                            />
                                            {errors.outraData && <small className="text-danger">{errors.outraData.message}</small>}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {/* <Controller
    as={
        <DatePicker
            size="large"
            format="DD-MM-YYYY"
            // placeholder={props.placeholder || ''}
            onBlur={() => {
                setFocus(false);
            }}
            onFocus={() => {
                setFocus(true);
            }}
            name="DatePickerTeste"
        />
    }
    name="DatePickerTeste"
    control={control}
    rules={{ required: "Informação necessária" }}
    onChange={([selected]) => ({ value: selected })}

/> */}

                            {/* ANTD */}
                            {/* <Controller
    as={<DatePicker
        // style={{ ...style, ...styleError }}
        size="large"
        format="DD-MM-YYYY"
        placeholder={props.placeholder || ''}
        onBlur={() => {
            setFocus(false);
        }}
        onFocus={() => {
            setFocus(true);
        }}
        name={name}
    />}
    name="DatePickerTeste"
    control={control}
    rules={{ required: true }}
    onChange={([selected]) => ({ value: selected })}

/> */}
                            {/* <button
    type="button"
    onClick={() => {
        reset({
            reactSelect: '',
        });
    }}
></button> */}

                        </div>

                    </form>
                </Modal.Body>
                <Modal.Footer className="modal-footer justify-content-between">
                    <Button variant="default" size="sm" onClick={props.handleClose}>Fechar</Button>
                    <Button variant="outline-primary" form="formTelefone" type="submit" size="sm">Salvar</Button>
                    <Button variant="outline-primary"
                        size="sm" onClick={() => {
                            const valores = getValues();
                            console.log(valores);
                            console.log("startDate: ", startDate);
                            // console.log("outraData: ", outraData);
                        }}>Teste</Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};

export default ModalTelefone;
