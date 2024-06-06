import React, { Suspense } from "react";
import { HeaderWrapper } from "@/Components/header/header-wrapper";
import AppWrapper from "@/providers/app-wrapper";

type APPLayoutProps = {
    children: React.ReactNode;
    i18nNamespaces: string[];
};

const AppLayout: React.FC<APPLayoutProps> = ({ children, i18nNamespaces }) => {
    return (
        <AppWrapper i18nNamespaces={i18nNamespaces}>
            <Suspense fallback={<div>Loading translations...</div>}>
                <HeaderWrapper />
                {children}
            </Suspense>
        </AppWrapper>
    );
};

export default AppLayout;
