import React from "react";
import { ThemeProvider } from "./theme-provider";
import I18nProviderWrapper from './i18n-provider'

const ProviderWrapper: React.FC<{ children: React.ReactNode }> = ({
    children,
}) => {
    return (
        <ThemeProvider defaultTheme="system">
            <I18nProviderWrapper i18nNamespaces={['default']}>
            {children}
            </I18nProviderWrapper>
        </ThemeProvider>
    );
};

export default ProviderWrapper;
