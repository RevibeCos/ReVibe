import React from 'react';
import { ThemeProvider } from './theme-provider';
import I18nProviderWrapper from './i18n-provider';


type ProviderWrapperProps = {
    children: React.ReactNode;
    i18nNamespaces: string[];
  };

  const ProviderWrapper: React.FC<ProviderWrapperProps> = ({ children, i18nNamespaces }) => {
    return (
        <ThemeProvider defaultTheme="system">
            <I18nProviderWrapper i18nNamespaces={i18nNamespaces}>
                {children}
            </I18nProviderWrapper>
        </ThemeProvider>
    );
};

export default ProviderWrapper;