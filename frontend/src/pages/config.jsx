import React, { useState } from 'react';
import { Link } from "react-router-dom";
import { Modal,Form,Button } from 'react-bootstrap';



export default function CreateRental() {
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
    const newParticipants = [...participants];
    newParticipants.splice(index, 1);
    setParticipants(newParticipants);
  };




  



const [show, setShow] = useState(false);
    const [email, setEmail] = useState('');
    const [showNewTenant, setshowNewTenant] = useState(false);
    const submit = (event) => {
        event.preventDefault();
      };
    const handleEmailChange = event => {
        setEmail(event.target.value);
      };
    const handleClose = ({type}) => {
      switch (type) {
        case "close":
          setShow(false);
          break;
        case "clear":
          setEmail("");
          break;
        case "showNewTenant":
          setshowNewTenant(true)
          break;
      }
    }
    const handleShow = () => setShow(true);








  return (
    <>
    <div className="create-wrapper pt-0 p-3">

          <p className="bg-primary p-2 text-white text-end">
            {/* rendre le prénom de l'user.id */}
            Vous êtes identifié comme <em>'Le nom de l'identifié'</em>
          </p>
      {/* vérifier si ce n'est pas méthode POST */}
      <form method="GET" action="createRental">

        <div className="p-4 pt-0">
          <div className="form-group row p-2">

            <label for="title" className="col-sm-2 col-form-label col-form-label-sm">Titre:</label>
            

            <div className="col-sm-10 ">

              <input type="text" className="form-control form-control-sm" id="title"/>

            </div>

          </div>
        

          <div className="form-group row p-2">

            <label for="description" className="col-sm-2 col-form-label col-form-label-sm">Description:</label>
            

            <div className="col-sm-10 ">

              <input type="text" className="form-control form-control-sm p-5" id="description"/>

            </div>

          </div>

        </div>

      </form>

      <div>Ici vient le component "tenantGroup"</div>
      
   

 



      <div>

      <ul>
        {participants.map((participant, index) => (
          <li key={index}>
            {participant}
            <button onClick={() => handleRemove(index)}>Supprimer</button>
          </li>
        ))}
      </ul>
    </div>

      






   




    <Button variant="mt-4 pt-4 text-primary" onClick={handleShow}>
                    <u>Ajouter un colocataire</u>
                  </Button>

                  <Modal show={show} onHide={() => {
                        handleClose({type: "close"})
                        }} centered>
                    <Modal.Header closeButton>
                      <Modal.Title>Créer un nouveau colocataire</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                      <Form onSubmit={submit} method="POST" action="createTenant">
                        <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
                          <Form.Label>Tapez son Email</Form.Label>
                          <input
                        value={newParticipant}
                      
                        onChange={e => setNewParticipant(e.target.value)}
                      />
                       <button onClick={handleAdd}>Ajouter</button>
                      <ul>
                      {participants.map((participant, index) => (
                        <li key={index}>
                          {participant}
                          <button onClick={() => handleRemove(index)}>Supprimer</button>
                        </li>
                      ))}
                    </ul>
                        </Form.Group>
                      </Form>
                    </Modal.Body>
                    <Modal.Footer>
                      <Button variant="secondary" onClick={() => {
                        handleClose({type: "close"})
                        handleClose({type: "clear"})
                        }}>
                        Valider
                      </Button>

                    </Modal.Footer>
                  </Modal>










      

    
    </div>



    <div className="p-2 bg-primary mt-auto">
        <Link to="/createTenant">
          <button type="submit" className="btn text-white" href="CreateTenant">Continuer</button>
        </Link>
      </div>
   

    
    </>
    );
  }
