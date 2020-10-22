import React, { Component } from 'react'
import axios from '../../axios';
import {ARR_DAYS,AVAILABILITIES_STORE} from '../../conf/constants'

export default class FormDayAvailability extends Component {

    constructor(props) {
        super(props)
    
        this.state = {
            isToDateNull:false,
        }
        this.formDisp = React.createRef();
        this.inputToDate = React.createRef();
        this.handleSubmitForm = this.handleSubmitForm.bind(this)
        this.handleSetToDateNull = this.handleSetToDateNull.bind(this)
    }
    componentDidMount(){
        this.props.getDoctorsAvailabilities()
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
        var { current:form } = this.formDisp
        var _formData = {};
        var formData = new FormData(form);

        var alertErrors = form.getElementsByClassName('alert-danger');

        for (let alert of alertErrors) {
            alert.remove()
        }

        axios.post(AVAILABILITIES_STORE,formData)
            .then( res => {
                const {data} = res
                console.log(data.status);

                if(data.status == 200){

                    delete data.data['doctor_id']
                    delete data.data['specialty_id']
                    delete data.data['day']
                    //console.log(data.data)

                    this.props.getDoctorsAvailabilities()
                    
                    var keys = Object.keys(data.data);

                    keys.forEach(key => {
                        form.querySelector('input[name="'+key+'"]').value = ''
                    });

                }
            })
            .catch( error => {
                if(error.response){
                    var {data} = error.response
                    const { errors } = data
                    
                    if(!errors){
                        alert('Hubo un error: '+data.message);
                        return;
                    }

                    const errorKey = Object.keys(errors)[0]

                    if(errorKey){
                        
                        const alert = document.createElement('div');
                        alert.classList.add('alert','alert-danger','animated--grow-in')
                        alert.append(document.createTextNode(errors[errorKey]))

                        form.append(alert);
                    }
                }
            })
        
        // Display the key/value pairs
        for (var pair of formData.entries()) {
            _formData[pair[0]] = pair[1]
        }
        //console.log(_formData);
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
                            <label htmlFor="from_hour">Hora Inicio:</label>
                            <input required type="text" className="form-control" name="from_hour" id="from_hour" placeholder="hh:mm AM/PM" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="to_hour">Hora Final:</label>
                            <input required type="text" className="form-control" name="to_hour" id="to_hour" placeholder="hh:mm AM/PM" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="max_patients">Max pacientes:</label>
                            <input required type="text" className="form-control" name="max_patients" id="max_patients" placeholder="Turnos" />
                        </div>
                    </div>
                    <div className="form-group row">
                        <div className="col-md-4">
                            <label htmlFor="from_date">Fecha Inicio:</label>
                            <input required type="text" className="form-control" name="from_date" id="from_date" placeholder="dd/mm/aaaa" />
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="to_date">Fecha Final:</label>
                            <input required ref={this.inputToDate} type="text" className="form-control" name="to_date" id="to_date" placeholder="dd/mm/aaaa" />
                            <div className="form-check pt-2">
                              <label className="form-check-label">
                                <input type="checkbox" className="form-check-input" name="isToDateNull" value={isToDateNull} onChange={this.handleSetToDateNull} />
                                Fecha indeterminada
                              </label>
                            </div>
                        </div>
                        <div className="col-md-4">
                            <label htmlFor="status">Estado de Disp:</label>
                            <select required className="form-control" name="status" id="status">
                                <option value="active">Activo</option>
                                <option value="inactive" selected>Inactivo</option>
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
