import { Link, Head } from '@inertiajs/react';
import { PageProps } from '@/types';
import { log } from 'console';

export default function Welcome({ auth, laravelVersion, phpVersion , data }: PageProps<{ laravelVersion: string, phpVersion: string ,data: any }>) {

    return (
        <>
{data.page_title}
        ddd
        </>
        );
    // Rest of your component code
}
