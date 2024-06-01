import React from "react";
import { ThemeProvider } from "./theme-provider";

const ProviderWrapper: React.FC<{ children: React.ReactNode }> = ({
    children,
}) => {
    return (
        <ThemeProvider defaultTheme="system" >
                {children}
        </ThemeProvider>
    );
};

export default ProviderWrapper;
