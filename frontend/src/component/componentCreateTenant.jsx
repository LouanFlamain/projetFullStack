import React, { useState , useContext } from "react";
import { Modal, Button, Form } from "react-bootstrap";
import { context } from "../context/context";

export default function ComponentCreateTenantManager() {
    const { logged, setLogged } = useContext(context);
    console.log("page/createRental logged", logged)
    const [show, setShow] = useState(false);
    const submit = (event) => {
        event.preventDefault();
      };
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [participants, setParticipants] = useState([]);
    const [newParticipant, setNewParticipant] = useState('');
    const handleAdd = () => { 
      if (!newParticipant) {
        return;
      }else{
      setParticipants([...participants, newParticipant]);
      setNewParticipant('');}
    };
    const handleRemove = index => {
    const newParticipants = 
      [...participants];
      newParticipants.splice(index, 1);
      setParticipants(newParticipants);
    };

    return (
        <div className="create-tenant__content p-4 mx-auto ">

        <div className="d-flex flex-row align-items-center create-tenant__info">
            <p className="p-2 border border-secondary rounded mb-0 w-25">{logged.username}</p>
            <p className="mb-0 pl-2 text-primary">(ceci est votre identifiant)</p>
        </div>
        
           {participants.map((participant, index) => (
            <div key={index} className="d-flex flex-row align-items-center create-tenant__info">
                <p className="p-2 border border-secondary rounded mb-0 w-25">{participant}</p>
                <button className="btn text-primary" onClick={() => handleRemove(index)}><u>Supprimer</u></button>
            </div>
            ))}
       

        <Button variant="mt-4 pt-4 text-primary" onClick={handleShow}>
          <u>Ajouter un colocataire</u>
        </Button>

        <Modal show={show} onHide={() => {
              handleClose({type: "close"})
              }} centered>
          <Modal.Header className="bg-primary" closeButton closeVariant='white'>
            <Modal.Title className="text-white">Créer un nouveau colocataire</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <Form onSubmit={submit} method="POST" action="createTenant">
              <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
                <div className="create-tenant__form d-flex flex-row align-items-center">
                  <Form.Label className="mb-0" >Tapez son Email</Form.Label>
                  <input
                     
                      type="email"
                      placeholder="name@example.com"
                      autoFocus
                      value={newParticipant} 
                      onChange={e => setNewParticipant(e.target.value)}
                  />
                  <button className="btn text-primary" onClick={handleAdd}><u>Ajouter</u></button>
                </div>
              
                {participants.map((participant, index) => (
                  <div key={index} className="d-flex flex-row align-items-center create-tenant__info">
                      <p className="p-2 border border-secondary rounded mb-0 w-25">{participant}</p>
                      <button className="btn text-primary" onClick={() => handleRemove(index)}><u>Supprimer</u></button>
                  </div>
                ))}
              </Form.Group>
            </Form>
          </Modal.Body>
          <Modal.Footer>
            <Button variant="primary" onClick={() => {
              handleClose({type: "close"})
              }}>
              Valider
            </Button>
          </Modal.Footer>
        </Modal>

    </div>
    );
}