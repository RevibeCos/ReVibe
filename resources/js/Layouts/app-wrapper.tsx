import React, { Suspense } from "react";
import { HeaderWrapper } from "@/Components/header/header-wrapper";
import ProviderWrapper from "@/providers/provider-wrapper";

type APPLayoutProps = {
    children: React.ReactNode;
    i18nNamespaces: string[];
};

const AppLayout: React.FC<APPLayoutProps> = ({ children, i18nNamespaces }) => {
    return (
        <ProviderWrapper i18nNamespaces={i18nNamespaces}>
            <Suspense fallback={<div>Loading translations...</div>}>
                <HeaderWrapper />
                {children}
            </Suspense>
        </ProviderWrapper>
    );
};

export default AppLayout;
