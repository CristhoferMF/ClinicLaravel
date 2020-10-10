import React, { Component } from 'react'
import axios from '../../axios';
import {ARR_DAYS} from '../../conf/constants'

export default class FormDayAvailability extends Component {

    constructor(props) {
        super(props)
    
        this.state = {
            isToDateNull:false
        }
        this.formDisp = React.createRef();
        this.inputToDate = React.createRef();
        this.handleSubmitForm = this.handleSubmitForm.bind(this)
        this.handleSetToDateNull = this.handleSetToDateNull.bind(this)
    }

    handleSetToDateNull(e){
        const isToDateNull = !this.state.isToDateNull
        const inputToDate = this.inputToDate.current
        
        inputToDate.value = ''

        if(isToDateNull){
            inputToDate.setAttribute('disabled','true');
        }else{
            inputToDate.removeAttribute('disabled');
        }

        this.setState({isToDateNull})
    }

    handleSubmitForm(e){
        e.preventDefault();
        var _formData = {};
        var formData = new FormData(this.formDisp.current);

        axios.post('/admin/doctors/availabilities',formData)
            .then( res => {
                console.log(res);
                console.log(res.data);
            })
        
        // Display the key/value pairs
        for (var pair of formData.entries()) {
            _formData[pair[0]] = pair[1]
        }
        console.log(_formData);
    }

    render() {
        
        const {isToDateNull} = this.state
        const {specialty_id,doctor_id,day} = this.props

        return (
            <div className="mb-5 border-bottom-primary">
                <h6 className="text-primary font-weight-bold">Formulario {ARR_DAYS[day].name}</h6>
                <form ref={this.formDisp} onSubmit={this.handleSubmitForm} method='POST' action='/'>
                    <input type="hidden" value={specialty_id} name="specialty_id"/>
                    <input type="hidden" value={doctor_id} name="doctor_id"/>
                    <input type="hidden" value={day} name="day"/>
                    <div className="form-group row">
                        <div className="col-md-4">
                            <label htmlFor="from-hour">Hora Inicio:</label>
                            <input type="text" className="form-control" name="from-hour" id="from-hour" placeholder="hh:mm AM/PM" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="to-hour">Hora Final:</label>
                            <input type="text" className="form-control" name="to-hour" id="to-hour" placeholder="hh:mm AM/PM" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="max_patients">Max pacientes:</label>
                            <input type="text" className="form-control" name="max_patients" id="max_patients" placeholder="Turnos" />
                        </div>
                    </div>
                    <div className="form-group row">
                        <div className="col-md-4">
                            <label htmlFor="from-date">Fecha Inicio:</label>
                            <input type="text" className="form-control" name="from-date" id="from-date" placeholder="dd/mm/aaaa" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="to-date">Fecha Final:</label>
                            <input ref={this.inputToDate} type="text" className="form-control" name="to-date" id="to-date" placeholder="dd/mm/aaaa" />
                            <div className="form-check pt-2">
                              <label className="form-check-label">
                                <input type="checkbox" className="form-check-input" name="isToDateNull" value={isToDateNull} onChange={this.handleSetToDateNull} />
                                Fecha indeterminada
                              </label>
                            </div>
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="status">Estado de Disp:</label>
                            <select className="form-control" name="status" id="status">
                                <option value="pending">Pediente</option>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div className="form-group row">
                        <div className="col text-center">
                            <button type="submit" className="btn btn-primary px-3">
                                Añadir Disponibilidad
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        )
    }
}
