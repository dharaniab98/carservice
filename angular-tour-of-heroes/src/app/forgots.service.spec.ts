import { TestBed } from '@angular/core/testing';

import { ForgotsService } from './forgots.service';

describe('ForgotsService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ForgotsService = TestBed.get(ForgotsService);
    expect(service).toBeTruthy();
  });
});
