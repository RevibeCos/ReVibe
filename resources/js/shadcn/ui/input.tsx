'use client';

/* eslint-disable @typescript-eslint/no-empty-interface */
import * as React from 'react';

import { Label } from '@/shadcn';

import { cn } from '@/shadcn/utils';

export interface InputProps
  extends React.InputHTMLAttributes<HTMLInputElement> {
  label?: string;
  containerClassName?: string;
  labelClassName?: string;
  errorMessage?: string;
  descriptionMessage?: string;
}

const Input = React.forwardRef<HTMLInputElement, InputProps>(
  (
    {
      className,
      type,
      errorMessage,
      label,
      descriptionMessage,
      labelClassName,
      containerClassName,
      ...props
    },
    ref
  ) => {
    return (
      <div className={containerClassName}>
        {label && (
          <Label
            className={cn(!!errorMessage && 'text-destructive', labelClassName)}
            htmlFor={props.id}
            children={label}
          />
        )}
        <input
          type={type}
          className={cn(
            'flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50',
            className
          )}
          ref={ref}
          {...props}
        />
        {descriptionMessage && (
          <p
            id={props.id}
            className={cn('text-[0.8rem] text-muted-foreground')}
          >
            {descriptionMessage}
          </p>
        )}
        {errorMessage && (
          <p
            id={props.id}
            className={cn('text-[0.8rem] font-medium text-destructive')}
          >
            {errorMessage}
          </p>
        )}
      </div>
    );
  }
);
Input.displayName = 'Input';

export { Input };
