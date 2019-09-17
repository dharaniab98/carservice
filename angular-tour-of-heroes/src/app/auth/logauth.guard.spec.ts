import { TestBed, async, inject } from '@angular/core/testing';

import { LogauthGuard } from './logauth.guard';

describe('LogauthGuard', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [LogauthGuard]
    });
  });

  it('should ...', inject([LogauthGuard], (guard: LogauthGuard) => {
    expect(guard).toBeTruthy();
  }));
});
