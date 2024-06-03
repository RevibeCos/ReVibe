import React from "react";
import { ThemeProvider } from "./theme-provider";
import HeaderWrapper from "@/Components/header/header-wrapper";

const ProviderWrapper: React.FC<{ children: React.ReactNode }> = ({
    children,
}) => {
    return (
        <ThemeProvider defaultTheme="system">
            <HeaderWrapper />
            {children}
        </ThemeProvider>
    );
};

export default ProviderWrapper;
