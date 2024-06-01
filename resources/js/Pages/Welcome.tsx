import { Head } from "@inertiajs/react";
import { Badge } from "@/shadcn/ui/badge";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/shadcn/ui/card";
import { ThemeSelector } from "@/Components/header/partials/theme-selector";
import { Button, Icon } from "@/shadcn";
import TranslationsProvider from "@/providers/translation-provider";
import { useTranslations } from "@/hooks";
import Test from "./Test";
import LanguageSelector from "@/Components/header/partials/LanguageSelector";

const i18nNamespaces = ["welcome"];

export default function Welcome() {
    const translations = useTranslations(i18nNamespaces);
    if (!translations) {
        return <div>Loading...</div>;
    }
    const { i18n, resources } = translations;
    return (
        <TranslationsProvider
            locale={i18n.language}
            namespaces={i18nNamespaces}
            resources={resources}
        >
            <Head title="Welcome" />
            <div className="flex flex-row mt-16 mx-16 gap-x-6 ">
                <ThemeSelector />
                <LanguageSelector />
                <Badge className="mb-2" variant="outline">
                    Badge
                </Badge>
            </div>
            <Card className="w-[30%] mx-auto">
                <CardHeader>
                    <CardTitle>Card Title</CardTitle>
                    <CardDescription>Card Description</CardDescription>
                </CardHeader>
                <CardContent>
                    <p>Card Content</p>
                </CardContent>
                <CardFooter>
                    <p>Card Footer</p>
                </CardFooter>
            </Card>
            <div className="flex flex-col gap-y-8 mx-auto max-w-[150px] mt-4">
                <Button variant="ghost">ghost</Button>
                <Button variant="destructive">destructive</Button>
                <Button variant="default">default</Button>
                <Button variant="link">link</Button>
                <Button variant="outline">outline</Button>
                <Button variant="secondary">secondary</Button>
            </div>
            <div>
                <Icon
                    name="search"
                    className=" h-4 w-4 text-muted-foreground"
                />
                <Test />
            </div>
        </TranslationsProvider>
    );
}
