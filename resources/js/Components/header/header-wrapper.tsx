import { useTranslations } from "@/hooks";
import TranslationContextProvider from "@/providers/translation-context-provider";
import Header from "./header";
import React, { PropsWithChildren, Suspense } from "react";

export const HeaderWrapper: React.FC<PropsWithChildren<{}>> = ({
    children,
}) => {
    return (
        <div>
            <Header />
            <main>{children}</main>
        </div>
    );
};
