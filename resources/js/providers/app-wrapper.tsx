import React from "react";
import { ThemeProvider } from "./theme-provider";
import TranslationLoaderWrapper from "./translation-loader-wrapper";

type ProviderWrapperProps = {
    children: React.ReactNode;
    i18nNamespaces: string[];
};

const AppWrapper: React.FC<ProviderWrapperProps> = ({
    children,
    i18nNamespaces,
}) => {
    return (
        <ThemeProvider defaultTheme="system">
            <TranslationLoaderWrapper i18nNamespaces={i18nNamespaces}>
                {children}
            </TranslationLoaderWrapper>
        </ThemeProvider>
    );
};

export default AppWrapper;
