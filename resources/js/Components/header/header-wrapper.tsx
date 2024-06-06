import { useTranslations } from "@/hooks";
import TranslationsProvider from "@/providers/translation-provider";
import Header from "./header";
import React, { PropsWithChildren, Suspense } from "react";

const i18nNamespaces: string[] = ["header"];

export const HeaderWrapper: React.FC<PropsWithChildren<{}>> = ({
    children,
}) => {
    return (
        <Suspense fallback={<div>Loading translations...</div>}>
            <Header />
            <main>{children}</main>
        </Suspense>
    );
};
