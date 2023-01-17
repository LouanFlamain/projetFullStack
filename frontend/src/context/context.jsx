import { createContext, useState } from "react";

export const context = createContext();

export function ContextProvider({ children }) {
  const [logged, setLogged] = useState(false);
  const [participants, setParticipants] = useState([]);
  const [dataCost, setDataCost] = useState([
    { QuiAPaye: '', Combien: '',pourquoi:'',quand:'',concerneQui:'',pourVous:''} ]);
  return (
    <context.Provider value={{ logged, setLogged, participants, setParticipants, dataCost, setDataCost }}>
      {children}
    </context.Provider>
  );
}
