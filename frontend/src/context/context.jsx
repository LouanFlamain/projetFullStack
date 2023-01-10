import { createContext, useState } from "react";

export const context = createContext();

export function ContextProvider({ children }) {
  return <context.Provider value={{}}>{children}</context.Provider>;
}
